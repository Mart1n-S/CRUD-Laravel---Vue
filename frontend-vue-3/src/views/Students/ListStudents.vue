<template>
    <div class="card">
        <div class="card-header">
            <h4>Etudiants<RouterLink to="/students/create" class="btn btn-primary float-end">Ajouter</RouterLink>
            </h4>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Créer le</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody v-if="this.students.length > 0">
                    <tr v-for="(student, index) in this.students" :key="index">
                        <td>{{ student.id }}</td>
                        <td>{{ student.firstname }}</td>
                        <td>{{ student.lastname }}</td>
                        <td>{{ student.email }}</td>
                        <td>{{ student.phoneNumber }}</td>
                        <td>{{ student.created_at }}</td>
                        <td>
                            <RouterLink :to="{ path: '/students/' + student.id + '/edit' }"
                                class="btn btn-success float-end w-100">Edit</RouterLink>
                            <button type="button" @click="deleteStudent(student.id)"
                                class="btn btn-danger float-end w-100 my-2">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <orbit-spinner :animation-duration="1200" :size="55" color="#41B883" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { OrbitSpinner } from 'epic-spinners'

export default {
    components: {
        OrbitSpinner,
    },
    name: 'students',
    data() {
        return {
            students: []
        }
    },
    mounted() {
        setTimeout(() => {
            this.getStudents();
        }, 1500);

    },
    methods: {
        getStudents() {
            axios.get('http://127.0.0.1:8000/api/students').then(resultat => {
                this.students = resultat.data.students
            });
        },
        deleteStudent(studentId) {
            console.log(studentId)
            if (confirm('Êtes-vous sur de vouloirs supprimés cet étudiant ? Cette action est irréversible.')) {
                axios.delete(`http://127.0.0.1:8000/api/students/${studentId}/delete`).then(resultat => {
                    alert(resultat.data.message);
                    this.getStudents();
                })
                    .catch(function (error) {
                        if (error.response) {
                            if (error.response.status === 404) {
                                alert(error.response.data.message);
                            }
                        }
                    });
            }
        }
    }
}
</script>