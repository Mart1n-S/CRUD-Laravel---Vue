<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Ajouter un étudiant</h4>
            </div>
            <div class="card-body">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                        {{ error[0] }}
                    </li>
                </ul>
                <div class="mb-3">
                    <label for="lastname">Nom</label>
                    <input type="text" v-model="model.student.lastname" id="lastname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="firstname">Prénom</label>
                    <input type="text" v-model="model.student.firstname" id="firstname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" v-model="model.student.email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phoneNumber">Téléphone</label>
                    <input type="tel" v-model="model.student.phoneNumber" id="phoneNumber" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="button" @click="saveStudent" class="btn btn-success">Sauvergarder</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'studentCreate',
    data() {
        return {
            errorList: '',
            model: {
                student: {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phoneNumber: ''
                }
            }
        }
    },
    methods: {
        saveStudent() {
            var myThis = this;
            axios.post('http://127.0.0.1:8000/api/students', this.model.student).then(resultat => {
                alert(resultat.data.message)

                this.model.student = {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phoneNumber: ''
                }
                this.errorList = '';
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            myThis.errorList = error.response.data.errors;
                        }
                        // console.log(error.response.data);
                        // console.log(error.response.status);
                        // console.log(error.response.headers);
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                })
        }
    }
}
</script>