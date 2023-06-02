<template>
    <div class="input__box date">
        <!-- <input
            @click="doOpen"
            class="bgType"
            name="work_on"
        > -->
        <vuejs-datepicker
            :language="ja"
            name="work_on"
            format="yyyy-MM-dd"
            v-model="work_on"
            input-class="bgType visible"
        />
    </div>
</template>
<script>
    import axios from 'axios'
    import VuejsDatepicker from 'vuejs-datepicker'
    import {ja} from 'vuejs-datepicker/dist/locale'

    export default {
        components: {
            'vuejs-datepicker': VuejsDatepicker
        },
        props: {
            mode: {
                type: String,
                require: false
            },
            id: {
                type: Number,
                require: false
            },
        },
		data: function() {
            // 必要に応じて変数を定義
            return {
                ja: ja,
                work_on: new Date(),
            }
        },
        created: function() {
            if(this.mode === "edit") {
                axios
                    .get('/api/charge-remarks/' + this.id, {})
                    .then(result => {
                        this.work_on = result.data.data.work_on
                    })
                    .catch(result => {
                        alert('メモ詳細を取得するのに失敗しました。')
                    })
            }
        },
        computed: {
            // 必要に応じてメソッドを定義
        },
        methods: {
            // 必要に応じてメソッドを定義
        },
    }
</script>
