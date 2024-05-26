# Projet CRUD Laravel-Vue.js

Ce projet est un petit CRUD (Create, Read, Update, Delete) développé avec Laravel côté serveur et Vue.js côté client. Il permet de gérer une liste d'étudiants.

## Objectif

L'objectif de ce projet est de découvrir et d'apprendre les bases de développement avec Laravel en tant que framework PHP côté serveur et Vue.js en tant que framework JavaScript côté client. Il met en pratique les concepts de développement d'une API RESTful avec Laravel et de la consommation de cette API avec Vue.js pour réaliser des opérations CRUD simples.

## Fonctionnalités

- Affichage de la liste des étudiants
- Ajout d'un nouvel étudiant
- Modification des informations d'un étudiant existant
- Suppression d'un étudiant de la liste

## Technologies utilisées

- Laravel
- Vue.js
- API REST

# Documentation de l'API

## Description

Cette API vous permet de gérer les étudiants.

## URL de base

- URL de base : `http://localhost:8000/api`

## Routes

### Obtenir tous les étudiants

- Méthode : GET
- Endpoint : `/students`
- Description : Récupérer la liste de tous les étudiants.

### Ajouter un étudiant

- Méthode : POST
- Endpoint : `/students`
- Description : Ajouter un nouvel étudiant.

### Obtenir un étudiant par ID

- Méthode : GET
- Endpoint : `/students/{id}`
- Description : Récupérer des informations sur un étudiant spécifique.

### Mettre à jour un étudiant par ID

- Méthode : PUT
- Endpoint : `/students/{id}/edit`
- Description : Mettre à jour des informations sur un étudiant spécifique.

### Supprimer un étudiant par ID

- Méthode : DELETE
- Endpoint : `/students/{id}/delete`
- Description : Supprimer un étudiant spécifique.
