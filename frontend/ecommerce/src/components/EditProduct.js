import React, { useState, useEffect } from 'react';
import axios from 'axios';

const EditProduct = ({ productId, onUpdate }) => {
  const [product, setProduct] = useState(null);
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');
  const [stock, setStock] = useState('');

  // Cargar los datos del producto a editar
  useEffect(() => {
    axios.get(`http://localhost/api/products/${productId}`)
      .then(response => {
        const product = response.data;
        setProduct(product);
        setName(product.name);
        setPrice(product.price);
        setStock(product.stock);
      })
      .catch(error => {
        console.error('Error al cargar el producto:', error);
      });
  }, [productId]);

  const handleSubmit = (e) => {
    e.preventDefault();

    axios.put(`http://localhost/api/products/${productId}`, {
      name,
      price,
      stock
    })
    .then(response => {
      onUpdate(response.data); // Informamos al componente padre que el producto fue actualizado
    })
    .catch(error => {
      console.error('Error al actualizar el producto:', error);
    });
  };

  if (!product) return <div>Cargando...</div>;

  return (
    <form onSubmit={handleSubmit}>
      <h2>Editar Producto</h2>
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
      <button type="submit">Actualizar Producto</button>
    </form>
  );
};

export default EditProduct;
