import React, { useState } from 'react';
import axios from 'axios';

const AddProduct = () => {
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');
  const [stock, setStock] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    // Crear el nuevo producto
    axios.post('http://lintic.test/api/products', {
      name,
      price,
      stock
    })
    .then(response => {
      alert('Producto creado con éxito');
    })
    .catch(error => {
      console.error('Error al crear el producto:', error);
    });
  };

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Nombre:
        <input 
          type="text" 
          value={name} 
          onChange={(e) => setName(e.target.value)} 
        />
      </label>
      <label>
        Precio:
        <input 
          type="number" 
          value={price} 
          onChange={(e) => setPrice(e.target.value)} 
        />
      </label>
      <label>
        Stock:
        <input 
          type="number" 
          value={stock} 
          onChange={(e) => setStock(e.target.value)} 
        />
      </label>
      <button type="submit">Agregar Producto</button>
    </form>
  );
};

export default AddProduct;
