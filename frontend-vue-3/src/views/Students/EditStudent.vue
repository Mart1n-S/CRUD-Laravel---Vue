<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Modifier un étudiant</h4>
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
                    <button type="button" @click="updateStudent" class="btn btn-success">Mettre à jour</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'studentEdit',
    data() {
        return {
            studentId: '',
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
    mounted() {
        this.studentId = this.$route.params.id;
        this.getStudent(this.$route.params.id);
    },
    methods: {
        getStudent(studentId) {
            axios.get(`http://127.0.0.1:8000/api/students/${studentId}`).then(resultat => {
                this.model.student = resultat.data.student
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 404) {
                            alert(error.response.data.message);
                        }
                    }
                });
        },
        updateStudent() {
            var myThis = this;
            axios.put(`http://127.0.0.1:8000/api/students/${this.studentId}/edit`, this.model.student).then(resultat => {
                alert(resultat.data.message)

                this.errorList = '';
            })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            myThis.errorList = error.response.data.errors;
                        }
                        if (error.response.status === 404) {
                            alert(error.response.data.message);
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