<?php
// Importar express
const express = require('express');
const app = express();
const port = 3000;


// Middleware para interpretar JSON en las solicitudes
app.use(express.json());

// Base de datos temporal (arreglo) de perros
let perros = [
    { id: 1, nombre: 'Firulais', raza: 'Pastor Alemán', edad: 3 },
    { id: 2, nombre: 'Max', raza: 'Golden Retriever', edad: 2 },
    { id: 3, nombre: 'Luna', raza: 'Beagle', edad: 5 },
    { id: 3, nombre: 'pupi', raza: 'Border Coli', edad: 7}
];

// Ruta principal
app.get('/', (req, res) => {
    res.send('¡Bienvenido a la API de perros!');
});

// Ruta para obtener todos los perros
app.get('/perros', (req, res) => {
    res.json(perros);
});


// Ruta para obtener un perro por su ID
app.get('/perros/:id', (req, res) => {
    const id = parseInt(req.params.id);
    const perro = perros.find(p => p.id === id);

    if (perro) {
        res.json(perro);
    } else {
        res.status(404).json({ mensaje: 'Perro no encontrado' });
    }
});


// Ruta para agregar un nuevo perro
app.post('/perros', (req, res) => {
    const nuevoPerro = {
        id: perros.length + 1,
        nombre: req.body.nombre,
        raza: req.body.raza,
        edad: req.body.edad
    };
    perros.push(nuevoPerro);
    res.status(201).json(nuevoPerro);
});

// Ruta para actualizar los datos de un perro existente
app.put('/perros/:id', (req, res) => {
    const id = parseInt(req.params.id);
    const perro = perros.find(p => p.id === id);

    if (perro) {
        perro.nombre = req.body.nombre || perro.nombre;
        perro.raza = req.body.raza || perro.raza;
        perro.edad = req.body.edad || perro.edad;
        res.json(perro);
    } else {
        res.status(404).json({ mensaje: 'Perro no encontrado' });
    }
});

// Ruta para eliminar un perro por su ID
app.delete('/perros/:id', (req, res) => {
    const id = parseInt(req.params.id);
    perros = perros.filter(p => p.id !== id);

    res.json({ mensaje: 'Perro eliminado correctamente' });
});

// Servidor en escucha
app.listen(port, () => {
    console.log(`Servidor de la API de perros corriendo en http://localhost:${port}`);
});

//comentario del Yañez