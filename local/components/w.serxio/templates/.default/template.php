<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="app">
    <div class="row">
        <form class="col-xs-12" methos="post" @submit.prevent="post()" ref="postform">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label>
                            Укажите путь к файлу на сервере:<br />
                            <input type="text" class="form-control" id="file" v-model="path" name="path">
                        </label>
                        <button type="button" :disabled="!path" @click="doFetch()"
                            class="btn btn-primary">Подгрузить</button>
                        <button type="submit" v-if="options.length != 0" :class="{'loading': isLoading}"
                            class="btn btn-success" :disabled="isLoading">Импорт</button>
                    </div>
                    <div class="form-group">
                        <label>Укажите Инфоблок:</label>
                        <select name="iblock_id" class="form-control">
                            <?
                                if(CModule::IncludeModule("iblock"))
                                {
                                    $res = CIBlock::GetList(
                                        Array(), 
                                        Array(
                                        'TYPE'=>'delivery', 
                                        'SITE_ID'=>SITE_ID, 
                                        'ACTIVE'=>'Y', 
                                        "CNT_ACTIVE"=>"Y"
                                        ), true
                                    );
                                    while($ar_res = $res->Fetch())
                                    {?>
                                    <option value="<?=$ar_res['ID'];?>"><?=$ar_res['NAME'];?></option>
                                    <?}
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" v-if="options.length != 0">
                        <select class="form-input">
                            <option v-for="option in options" :value="option.Code" :key="option.Code">{{option.Address}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-xs-12">
            <div class="alert alert-success" v-if="isComplete">{{msg}}</div>
        </div>
    </div>
</div>
<script>
    var form = BX.Vue.create({
        el: '#app',
        data() {
            return {
                path: '/local/components/up/boxberry/response.json',
                options: [],
                isLoading: false,
                isComplete: false,
                iblock_id: '',
                section_id: '',
                msg: 'Импорт завершен!'
            }
        },
        methods: {
            async fetchUrl(path) {
                try {
                    let response = await fetch(path);
                    let data = await response.json();

                    this.options = data
                } catch (error) {
                    throw new Error(error)
                }
            },
            doFetch() {
                this.fetchUrl(this.path)
            },
            post() {
                this.isLoading = true;

                $.ajax({
                        type: 'POST',
                        url: 'import.php',
                        data: $(this.$refs.postform).serialize()
                    })
                    .done(function (data) {
                        form.isLoading = false;
                        form.isComplete = true;
                        form.msg = data
                    })
            }
        }
    })
</script>