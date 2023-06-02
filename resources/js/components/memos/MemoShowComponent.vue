<template>
    <div class="allWrapper input__area">
        <modal ref="modal" @parentMethod="executeMethod">
            <template v-slot:message>{{ message }}</template>
            <template v-slot:ok>OK</template>
            <template v-slot:cancel>戻る</template>
        </modal>
        <div class="content__wrap">
            <div class="content__section">
                <div class="content__header">
                    <div class="content__title">
                        <h1 class="h1">メモ詳細</h1>
                        <span class="en">Memo Details</span>
                    </div>
                    <div class="content__edit">
                        <ul class="flex__wrap f__start">
                            <li><a :href="url_edit">編集</a></li>
                            <li><a @click.prevent="confirm">削除</a></li>
                        </ul>
                    </div>
                </div>
                <div class="content__floar">
                    <div class="content__floar__inner">
                        <div class="content__box">
                            <div class="content__box__inner">
                                <div class="content__input">
                                    <div class="headline">スタッフ</div>
                                    <div class="input__text">
                                        <span v-if="memo">{{ memo.staff }}</span>
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline">日付</div>
                                    <div class="input__text">
                                        <span v-if="memo">{{ moment(memo.work_on) }} <span v-if="memo.time_type === 0">未定</span><span v-if="memo.time_type === 1">AM</span><span v-if="memo.time_type === 2">PM</span></span>
                                        <!-- <span v-if="memo">{{ date_format(memo.updated_at, 'Y年m月d日') }}</span> -->
                                    </div>
                                </div>
                                <div class="content__input">
                                    <div class="headline">メモ詳細</div>
                                    <div class="input__text">
                                        <span v-if="memo">{{ memo.remarks }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from './../../utilities/axios'
    import errorHandling from './../../utilities/handling'
    import Modal from '../common/Modal.vue'
    import moment from 'moment'

    export default {
        // 必要に応じて、bladeから渡されるデータを定義
        components: {
            'modal' : Modal
        },
        props: {
            id: {
                type: Number
            },
            isCharge: {
                type: String
            },
            isViewer: {
                type: String
            },
            urlPrefix: {
                type: String
            },
        },
        data() {
            // 必要に応じて変数を定義
            return {
                memo: null,
                message: '',
                mode: '',
            }
        },
        created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
            // 元請け情報を取得
            console.log(this.id)
            axios
                .get('/api/charge-remarks/' + this.id, {})
                .then(result => {
                    this.memo = result.data
                })
                .catch(result => {
                    alert('元請け情報の取得に失敗しました。')
                })
        },
        computed: {
            // 必要に応じてメソッドを定義
            url_edit: function() {
                return this.urlPrefix + '/memos/edit/' + this.id
            }
        },
        methods: {
            // 必要に応じて、ボタン押下時などに呼び出すLaravelのAPIを呼び出すメソッドを定義
            // 日付の出力をmoment.jsで変換
            moment: function (date) {
                return moment(date).format('YYYY年MM月DD日')
            },
            // ボタン押下時、確認メッセージを表示する
            confirm: function() {
                this.message = 'メモを削除します。よろしいでしょうか？'
                this.mode = 'delete'
                // if (this.projectOrderer.has_project) {
                //     this.message = '案件に紐づいている為、元請け情報を削除できません。'
                //     this.mode = ''
                // } else {
                //     this.message = 'メモを削除します。よろしいでしょうか？'
                //     this.mode = 'delete'
                // }
                this.$refs.modal.openModal()
            },
            // // (モーダル表示後)モードに応じた処理を行う
            executeMethod: function() {
                if (this.mode === 'delete') {
                    this.deleteMemo()
                }
            },
            // // 元請け情報を削除する
            deleteMemo: function() {
                // OKボタンが押下された場合、案件削除APIを呼び出す
                axios
                    .delete('/api/charge-remarks/' + this.id, {})
                    .then(result => {
                        alert('メモを削除しました。')
                        // 削除後、元請け一覧へ戻る
                        location.href = this.urlPrefix + '/memos'
                    })
                    .catch(result => {
                        errorHandling.errorMessage(result)
                    })
            },
        },
        watch: {
            // 必要に応じてメソッドを定義
        }
    }
</script>
