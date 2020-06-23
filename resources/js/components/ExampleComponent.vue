<template>

        <div class="container" style="margin-top: 30px">
            <div class="row">
                <div class="col-md-4"> </div>
                <div class="col-md-4">
                    <h4>Форма обратной связи </h4>
                    <div >
                        <div class="form-group">
                            <label for="name">Ваше имя:</label>
                            <input type="name" name="name" class="form-control" id="name" placeholder="Name" v-model="name">
                            <form-error v-if="errors.name" :errors="errors">
                                @{{ errors.name }}
                            </form-error>
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона:</label>
                            <input type="phone" name="phone" class="form-control" id="phone" placeholder="Phone" v-model="phone">
                            <form-error v-if="errors.phone" :errors="errors">
                                @{{ errors.phone }}
                            </form-error>
                        </div>
                        <div class="form-group">
                            <label for="message">Сообщение:</label>
                            <textarea class="form-control" name="mess" rows="3" v-model="mess"></textarea>
                            <form-error v-if="errors.mess" :errors="errors">
                                @{{ errors.mess }}
                            </form-error>
                        </div>
                        <button type="submit" class="btn btn-info" @click="sendMess">Отправить сообщение</button>
                    </div>
                </div>
                <div class="col-md-4"> </div> </div>
        </div>
</template>

<script>
    import Vue from 'vue'
    import axios from 'axios';
    import r from '../route';
    import FormError from './FormError.vue';

    export default {
        components: {
            FormError,
        },
        data(){
            return{
                    errors: [],
                    name:'',
                    phone:'',
                    mess:'',


            }
        },
        methods:{
            sendMess(){
                this.errors=[],
                axios.post(r("mess.update"), {
                    name: this.name,
                    phone:this.phone,
                    mess:this.mess,
                }).then((response)=>{

                    if (response.data.result==true){

                    this.$swal("Спасибо за ваше сообщение!!!", "", "success");

                    }
                    else {
                        this.errors=response.data.errors;

                    }
            })


            },
        }
    }
</script>
