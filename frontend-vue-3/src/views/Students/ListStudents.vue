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
                            <button type="button" class="btn btn-danger float-end w-100 my-2">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="7">Loading</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'students',
    data() {
        return {
            students: []
        }
    },
    mounted() {
        this.getStudents();
    },
    methods: {
        getStudents() {
            axios.get('http://127.0.0.1:8000/api/students').then(resultat => {
                this.students = resultat.data.students
            });
        }
    }
}
</script>