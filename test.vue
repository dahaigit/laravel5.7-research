<template>
    <div class="wrapper">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-list"></i> {{ pageTitle }}
                            <div class="card-actions">
                                <router-link :to="{ path: '/article/add/'}"><i class="icon-plus"></i></router-link>
                            </div>
                        </div>
                        <div class="card-block">
                            <el-form :inline="true" :model="searchObj" class="demo-form-inline">
                                <el-form-item label="文章分类">
                                    <el-select v-model="searchObj.article_category_id" placeholder="文章分类">
                                        <el-option label="全部" value=""></el-option>
                                        <el-option
                                            v-for="item in categoryItems"
                                            :label="item.name"
                                            :key="item.id"
                                            :value="item.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="fetchList(1)">查询</el-button>
                                </el-form-item>
                            </el-form>
                            <el-tabs v-model="searchObj.activeName" @tab-click="searchClick">
                                <el-tab-pane  label="全部" name=""></el-tab-pane>
                                <el-tab-pane  label="每日推荐" name="1"></el-tab-pane>
                                <el-tab-pane  label="热门精选" name="2"></el-tab-pane>
                                <el-tab-pane  label="置顶文章" name="3"></el-tab-pane>
                            </el-tabs>
                            <table class="table table-bordered table-striped table-sm table-hover">
                                <thead class="thead-inverse">
                                <tr>
                                    <th class="text-center align-middle" title='从大到小'>排序</th>
                                    <th class="text-center align-middle">标题</th>
                                    <!-- <th class="text-center align-middle">作者</th> -->
                                    <th class="text-center align-middle">分类</th>
                                    <th class="text-center align-middle">缩略图</th>
                                    <th class="text-center align-middle" title="点击量">真实/显示</th>
                                    <th class="text-center align-middle">标签</th>
                                    <th class="text-center align-middle">状态</th>
                                    <th class="text-center align-middle">app地址</th>
                                    <th class="text-center align-middle">预览</th>
                                    <th class="text-center align-middle">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in items">
                                    <td class="text-center align-middle">{{ item.weight }}</td>
                                    <td class="text-center align-middle">
                                        <router-link :to="{ path: '/article/edit/' + item.id }">{{ item.title }}</router-link>
                                    </td>
                                    <!-- <td class="text-center align-middle">
                                       {{ item.nickname }} <br />

                                    </td> -->
                                    <td class="text-center align-middle">
                                        {{ item.category_name }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <img v-bind:src="item.thumbnail" alt="" class="rounded" style="width:3rem;height:3rem;">
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ item.r_hits }} / {{ item.f_hits }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-danger" v-if="item.is_recommend">推荐</span>
                                        <span class="badge badge-info" v-if="item.is_hot">精选</span>
                                        <span class="badge badge-info" v-if="item.is_top">置顶</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        <el-button-group>
                                            <el-button size="small" v-if="item.status == 1" type="success">已发布</el-button>
                                            <el-button size="small" v-if="item.status == 2" type="danger">未发布</el-button>
                                        </el-button-group>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a  @click="lookAppAddr(item.id)">复制</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a  @click="look(item.id)">预览</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <el-button size="mini" @click="dialogVisible = true,priview_id=item.id">预览</el-button>
                                        <el-button size="mini" v-on:click="remove(item.id)">删除</el-button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="block">
                                <el-pagination
                                    @current-change="handleCurrentChange"
                                    :current-page="currentPage"
                                    :page-size="pageSize"
                                    layout="total, prev, pager, next"
                                    :total="total">
                                </el-pagination>
                            </div>

                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <!--/col-->
            </div>
        </div>
        <!-- priview dialog -->
        <el-dialog
            title="预览"
            :visible.sync="dialogVisible"
            width="100%"
            center=true>
            <div  style="margin:0px auto;width:50%;">
                <img v-bind:src="qrCodeHostUrl + hostUrl + localUrl + priview_id" >
            </div>
            <span slot="footer" class="dialog-footer">
          <el-button @click="dialogVisible = false">取 消</el-button>
          <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
        </span>
        </el-dialog>
        <!-- /priview dialog -->
        <!-- ./modal -->
        <modal class="applymodal" title="Modal title" v-model="appAddrModal" @ok="appAddrModal = false" effect="fade/zoom">
            <div slot="modal-header" class="modal-header">
                <h5 class="modal-title">请复制地址：</h5>
            </div>
            <div slot="modal-body" class="modal-body">
                <div>
                    <input type="text" style="width:300px;" v-model="lookItem" placeholder="" />
                </div>

            </div>
            <div slot="modal-footer" class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" @click="appAddrModal = false,lookItem = ''">关闭</button>
            </div>
        </modal>
        <!-- ./modal -->
    </div>
</template>

<script>
    import { Loading } from 'element-ui'
    import modal from 'vue-strap/src/Modal'
    export default {
        components: {
            Loading,
            modal
        },
        name: 'ArticleHome',
        mounted: function () {
            this.setDocumentTitle()
            this.fetchList(1)
            this.fetchCategory()
        },
        data: function () {
            return {
                apiBaseUrl: '/article/articles/',
                pageTitle: '文档列表',
                currentPage: 1,
                lastPage: 1,
                appAddrModal: false,
                lookItem: '',
                total: 0,
                pageSize: 10,
                items: [],
                searchObj: {
                    article_category_id: '',
                    is_hot: '',
                    activeName: '',
                    is_recommend: '',
                    is_top: ''
                },
                categoryItems: [],
                dialogVisible: false,
                priview_id: 0,
                qrCodeHostUrl: 'http://qr.liantu.com/api.php?text=',
                localUrl: '/h5/article/previewpage?id=',
                hostUrl: 'http://bkapi.beta.benbenland.com/'
            }
        },
        methods: {
            setDocumentTitle () {
                document.title = '文档列表'
            },
            look (id) {
                location.href = this.hostUrl + this.localUrl + id
            },
            lookAppAddr (id) {
                this.appAddrModal = true
                this.lookItem = 'bbland://article-detail/' + id
            },
            // fetch list
            fetchList (page) {
                let msg = Loading.service({
                    fullscreen: true,
                    test: '正在加载中...'
                })
                this.$axios.get(this.apiBaseUrl, {
                    params: {
                        page: page,
                        article_category_id: this.searchObj.article_category_id,
                        is_hot: this.searchObj.is_hot,
                        is_top: this.searchObj.is_top,
                        is_recommend: this.searchObj.is_recommend
                    }
                }).then((response) => {
                    let data = response.data.data
                    this.currentPage = data.currentPage
                this.lastPage = data.lastPage
                this.total = data.total
                this.pageSize = data.perPage
                this.items = data.rows
                this.hostUrl = data.hostUrl
                msg.close()
            }).catch((error) => {
                    this.$alert(error.message)
                msg.close()
            })
            },
            searchClick () {
                this.searchObj.is_hot = ''
                this.searchObj.is_recommend = ''
                this.searchObj.is_top = ''
                switch (parseInt(this.searchObj.activeName)) {
                    case 1:
                        this.searchObj.is_recommend = 1
                        break
                    case 2:
                        this.searchObj.is_hot = 1
                        break
                    case 3:
                        this.searchObj.is_top = 1
                        break
                }
                this.fetchList(1)
            },
            fetchCategory () {
                this.$axios.get('/article/categories/', {
                    params: {
                        page: 1
                    }
                }).then((response) => {
                    let data = response.data
                    this.categoryItems = data.data.collection
            }).catch((error) => {
                    this.$alert(error.message)
            })
            },
            // remove by id
            remove (id) {
                this.$confirm('你确定要删除吗？', '消息', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.delete(this.apiBaseUrl + id).then(response => {
                    return response.data
                }).then(data => {
                    this.$alert(`${data.msg}`, '提示', {
                    confirmButtonText: '好的',
                    type: 'success',
                    callback: action => {
                    this.fetchList(this.currentPage) // 删除成功，刷新界面
            }
            })
            }).catch(error => {
                    this.$alert(error.message)
            })
            }).catch(() => {
                })
            },
            // restore by id
            restore (id) {
                this.$axios.get(this.apiBaseUrl + id + '/restore').then(response => {
                    return response.data
                }).then(data => {
                    this.$alert(`${data.msg}`, '提示', {
                    confirmButtonText: '好的',
                    type: 'success',
                    callback: action => {
                    this.fetchList(this.currentPage) // 还原成功，刷新界面
            }
            })
            }).catch(error => {
                    this.$alert(error.message)
            })
            },
            handleCurrentChange (page) {
                this.fetchList(page)
            }
        }
    }
</script>
<style>
    .el-dialog el-dialog--small{
        border:1px solid blue;
    }
</style>
