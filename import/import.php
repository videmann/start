<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    
    if(!is_array($_POST)) return;

    use Bitrix\Main\IO,
    Bitrix\Main\Application;

    $path = $_POST['path'];
    $section_id = $_POST['section_id'];
    $iblock_id = $_POST['iblock_id'];

    $file = new IO\File(Application::getDocumentRoot().$_POST['path']);
    if($file->isExists())
    {
        try 
        {
            $response = json_decode($file->getContents());
            if(is_array($response) && CModule::IncludeModule("iblock"))
            {
                foreach ($response as $key => $place)
                {
                    $rsItems = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $iblock_id, 'NAME' => $place->Name),false,false,array('ID'));
                    if ($arItem = $rsItems->GetNext())
                    {
                        echo 'Элементы уже добавлены';
                        return false;
                    } else {
                        $el = new CIBlockElement;
                    
                        $arLoadProductArray = Array(
                            "MODIFIED_BY"    => $USER->GetID(),
                            "IBLOCK_SECTION_ID" => 1,
                            "IBLOCK_ID"      => $iblock_id,
                            "PROPERTY_VALUES" => array(
                                "Address"               => $place->Address,
                                "Phone"                 => $place->Phone,
                                "WorkSchedule"          => $place->WorkSchedule,
                                "TripDescription"       => $place->TripDescription,
                                "DeliveryPeriod"        => $place->DeliveryPeriod,
                                "CityCode"              => $place->CityCode,
                                "CityName"              => $place->CityName,
                                "TariffZone"            => $place->TariffZone,
                                "Settlement"            => $place->Settlement,
                                "Area"                  => $place->Area,
                                "Country"               => $place->Country,
                                "OnlyPrepaidOrders"     => $place->OnlyPrepaidOrders,
                                "AddressReduce"         => $place->AddressReduce,
                                "Acquiring"             => $place->Acquiring,
                                "DigitalSignature"      => $place->DigitalSignature,
                                "TypeOfOffice"          => $place->TypeOfOffice,
                                "NalKD"                 => $place->NalKD,
                                "Metro"                 => $place->Metro,
                                "VolumeLimit"           => $place->VolumeLimit,
                                "LoadLimit"             => $place->LoadLimit,
                                "GPS"                   => $place->GPS
                            ),
                            "NAME"           => $place->Name,
                            "ACTIVE"         => "Y"
                        );
                        
                        if ($PRODUCT_ID = $el->Add($arLoadProductArray))
                            echo "New ID: ".$PRODUCT_ID;
                        else
                            echo "Error: ".$el->LAST_ERROR;
                    }
                }
            }

            echo 'success';
        }
        catch (Exception $e)
        {
            echo $e;
        }
    };
?>