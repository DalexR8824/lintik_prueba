import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ProductList from './components/ProductList';

function App() {
  const [products, setProducts] = useState([]);

  // Obtener los productos desde la API
  useEffect(() => {
    axios.get('http://lintic.test/api/products')
      .then(response => {
        setProducts(response.data); // Guardar los productos en el estado
      })
      .catch(error => {
        console.error('Error al obtener los productos:', error);
      });
  }, []);

  // Función para agregar un producto
  const handleAddProduct = (product) => {
    axios.post('http://lintic.test/api/products', product)
      .then(response => {
        setProducts([...products, response.data]); // Añadir el nuevo producto a la lista
      })
      .catch(error => {
        console.error('Error al agregar el producto:', error);
      });
  };

  // Función para eliminar un producto
  const handleDeleteProduct = (productId) => {
    axios.delete(`http://lintic.test/api/products/${productId}`)
      .then(() => {
        setProducts(products.filter(product => product.id !== productId)); // Eliminar del estado
      })
      .catch(error => {
        console.error('Error al eliminar el producto:', error);
      });
  };

  // Función para editar un producto
  const handleEditProduct = (product) => {
    axios.put(`http://lintic.test/api/products/${product.id}`, product)
      .then(response => {
        setProducts(products.map(p => p.id === product.id ? response.data : p)); // Actualizar en el estado
      })
      .catch(error => {
        console.error('Error al editar el producto:', error);
      });
  };

  return (
    <div className="App">
      <ProductList 
        products={products} 
        onAddProduct={handleAddProduct} 
        onDeleteProduct={handleDeleteProduct} 
        onEditProduct={handleEditProduct} 
      />
    </div>
  );
}

export default App;
