import React, { useState } from 'react';

const ProductList = ({ products, onAddProduct, onDeleteProduct, onEditProduct }) => {
  const [newProduct, setNewProduct] = useState({
    name: '',
    price: '',
    stock: ''
  });
  const [editingProduct, setEditingProduct] = useState(null); // Producto que se está editando

  // Manejar los cambios en el formulario de agregar producto
  const handleChange = (e) => {
    const { name, value } = e.target;
    setNewProduct({
      ...newProduct,
      [name]: value
    });
  };

  // Enviar el producto cuando se haga clic en el botón de agregar
  const handleSubmit = (e) => {
    e.preventDefault();
    onAddProduct(newProduct);
    setNewProduct({
      name: '',
      price: '',
      stock: ''
    });
  };

  // Función para manejar la eliminación del producto
  const handleDelete = (productId) => {
    onDeleteProduct(productId); // Llamamos a la función para eliminar el producto
  };

  // Función para manejar la edición del producto
  const handleEdit = (product) => {
    setEditingProduct(product); // Establecemos el producto a editar
  };

  // Función para actualizar un producto
  const handleEditSubmit = (e) => {
    e.preventDefault();
    onEditProduct(editingProduct); // Llamamos a la función para editar el producto
    setEditingProduct(null); // Ocultamos el formulario de edición
  };

  // Manejar los cambios en el formulario de edición
  const handleEditChange = (e) => {
    const { name, value } = e.target;
    setEditingProduct({
      ...editingProduct,
      [name]: value
    });
  };

  return (
    <div>
      <h1>Lista de Productos</h1>

      {/* Formulario para agregar producto */}
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          name="name"
          placeholder="Nombre del producto"
          value={newProduct.name}
          onChange={handleChange}
        />
        <input
          type="number"
          name="price"
          placeholder="Precio"
          value={newProduct.price}
          onChange={handleChange}
        />
        <input
          type="number"
          name="stock"
          placeholder="Stock"
          value={newProduct.stock}
          onChange={handleChange}
        />
        <button type="submit">Agregar Producto</button>
      </form>

      {/* Si estamos editando un producto, mostramos un formulario de edición */}
      {editingProduct && (
        <div>
          <h2>Editar Producto</h2>
          <form onSubmit={handleEditSubmit}>
            <input
              type="text"
              name="name"
              placeholder="Nombre"
              value={editingProduct.name}
              onChange={handleEditChange}
            />
            <input
              type="number"
              name="price"
              placeholder="Precio"
              value={editingProduct.price}
              onChange={handleEditChange}
            />
            <input
              type="number"
              name="stock"
              placeholder="Stock"
              value={editingProduct.stock}
              onChange={handleEditChange}
            />
            <button type="submit">Guardar Cambios</button>
          </form>
        </div>
      )}

      {/* Lista de productos */}
      <ul>
        {products.length > 0 ? (
          products.map((product) => (
            <li key={product.id}>
              {product.name} - ${product.price} - Stock: {product.stock}
              
              {/* Botones para editar y eliminar */}
              <button onClick={() => handleEdit(product)}>Editar</button>
              <button onClick={() => handleDelete(product.id)}>Eliminar</button>
            </li>
          ))
        ) : (
          <p>No hay productos disponibles.</p>
        )}
      </ul>
    </div>
  );
};

export default ProductList;
