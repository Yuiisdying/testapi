const express = require('express');
const app = express();
const PORT = 5000;

// JSONPlaceholder API
const PLACEHOLDER = 'https://jsonplaceholder.typicode.com';

// Middleware
app.use(express.json());

// ==================== ENDPOINT 1: USERS ====================
// GET all users
app.get('/api/users', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/users`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch users' });
  }
});

// GET user by ID
app.get('/api/users/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/users/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch user' });
  }
});

// POST create new user (mock)
app.post('/api/users', (req, res) => {
  const newUser = {
    id: Math.floor(Math.random() * 10000),
    name: req.body.name || 'New User',
    email: req.body.email || 'user@example.com',
    ...req.body
  };
  res.status(201).json(newUser);
});

// PUT update user (mock)
app.put('/api/users/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'User updated', data: req.body });
});

// PATCH partially update user (mock)
app.patch('/api/users/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'User partially updated', data: req.body });
});

// DELETE user (mock)
app.delete('/api/users/:id', (req, res) => {
  res.status(204).json({ message: `User ${req.params.id} deleted` });
});

// ==================== ENDPOINT 2: POSTS ====================
// GET all posts
app.get('/api/posts', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/posts`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch posts' });
  }
});

// GET post by ID
app.get('/api/posts/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/posts/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch post' });
  }
});

// POST create new post (mock)
app.post('/api/posts', (req, res) => {
  const newPost = {
    id: Math.floor(Math.random() * 10000),
    userId: req.body.userId || 1,
    title: req.body.title || 'New Post',
    body: req.body.body || 'Post content',
    ...req.body
  };
  res.status(201).json(newPost);
});

// PUT update post (mock)
app.put('/api/posts/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Post updated', data: req.body });
});

// DELETE post (mock)
app.delete('/api/posts/:id', (req, res) => {
  res.status(204).json({ message: `Post ${req.params.id} deleted` });
});

// ==================== ENDPOINT 3: COMMENTS ====================
// GET all comments
app.get('/api/comments', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/comments`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch comments' });
  }
});

// GET comment by ID
app.get('/api/comments/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/comments/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch comment' });
  }
});

// POST create new comment (mock)
app.post('/api/comments', (req, res) => {
  const newComment = {
    id: Math.floor(Math.random() * 10000),
    postId: req.body.postId || 1,
    name: req.body.name || 'Comment',
    email: req.body.email || 'user@example.com',
    body: req.body.body || 'Comment body',
    ...req.body
  };
  res.status(201).json(newComment);
});

// PUT update comment
app.put('/api/comments/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Comment updated', data: req.body });
});

// DELETE comment
app.delete('/api/comments/:id', (req, res) => {
  res.status(204).json({ message: `Comment ${req.params.id} deleted` });
});

// ==================== ENDPOINT 4: ALBUMS ====================
// GET all albums
app.get('/api/albums', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/albums`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch albums' });
  }
});

// GET album by ID
app.get('/api/albums/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/albums/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch album' });
  }
});

// POST create new album
app.post('/api/albums', (req, res) => {
  const newAlbum = {
    id: Math.floor(Math.random() * 10000),
    userId: req.body.userId || 1,
    title: req.body.title || 'New Album',
    ...req.body
  };
  res.status(201).json(newAlbum);
});

// PUT update album
app.put('/api/albums/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Album updated', data: req.body });
});

// DELETE album
app.delete('/api/albums/:id', (req, res) => {
  res.status(204).json({ message: `Album ${req.params.id} deleted` });
});

// ==================== ENDPOINT 5: TODOS ====================
// GET all todos
app.get('/api/todos', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/todos`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch todos' });
  }
});

// GET todo by ID
app.get('/api/todos/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/todos/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch todo' });
  }
});

// POST create new todo
app.post('/api/todos', (req, res) => {
  const newTodo = {
    id: Math.floor(Math.random() * 10000),
    userId: req.body.userId || 1,
    title: req.body.title || 'New Todo',
    completed: req.body.completed || false,
    ...req.body
  };
  res.status(201).json(newTodo);
});

// PUT update todo
app.put('/api/todos/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Todo updated', data: req.body });
});

// DELETE todo
app.delete('/api/todos/:id', (req, res) => {
  res.status(204).json({ message: `Todo ${req.params.id} deleted` });
});

// ==================== ENDPOINT 6: PHOTOS/PRODUCTS ====================
// GET all photos
app.get('/api/photos', async (req, res) => {
  try {
    const limit = req.query.limit || 10;
    const response = await fetch(`${PLACEHOLDER}/photos?_limit=${limit}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch photos' });
  }
});

// GET photo by ID
app.get('/api/photos/:id', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/photos/${req.params.id}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch photo' });
  }
});

// POST create new photo
app.post('/api/photos', (req, res) => {
  const newPhoto = {
    id: Math.floor(Math.random() * 10000),
    albumId: req.body.albumId || 1,
    title: req.body.title || 'New Photo',
    url: req.body.url || 'https://via.placeholder.com/600',
    ...req.body
  };
  res.status(201).json(newPhoto);
});

// PUT update photo
app.put('/api/photos/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Photo updated', data: req.body });
});

// DELETE photo
app.delete('/api/photos/:id', (req, res) => {
  res.status(204).json({ message: `Photo ${req.params.id} deleted` });
});

// ==================== ENDPOINT 7: PRODUCTS ====================
// GET all products 
app.get('/api/products', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/posts?_limit=10`);
    const posts = await response.json();
    const products = posts.map(item => ({
      id: item.id,
      name: `Product ${item.id}`,
      description: item.body,
      price: Math.floor(Math.random() * 1000) + 10
    }));
    res.json(products);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch products' });
  }
});

// GET product by ID
app.get('/api/products/:id', (req, res) => {
  res.json({
    id: req.params.id,
    name: `Product ${req.params.id}`,
    price: Math.floor(Math.random() * 1000) + 10,
    stock: Math.floor(Math.random() * 100)
  });
});

// POST create new product
app.post('/api/products', (req, res) => {
  const newProduct = {
    id: Math.floor(Math.random() * 10000),
    name: req.body.name || 'New Product',
    price: req.body.price || 99.99,
    stock: req.body.stock || 0,
    ...req.body
  };
  res.status(201).json(newProduct);
});

// PUT update product
app.put('/api/products/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Product updated', data: req.body });
});

// PATCH partially update product
app.patch('/api/products/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Product partially updated', data: req.body });
});

// DELETE product
app.delete('/api/products/:id', (req, res) => {
  res.status(204).json({ message: `Product ${req.params.id} deleted` });
});

// ==================== ENDPOINT 8: ORDERS ====================
// GET all orders
app.get('/api/orders', (req, res) => {
  res.json([
    { id: 1, userId: 1, total: 150, status: 'completed' },
    { id: 2, userId: 2, total: 200, status: 'pending' },
    { id: 3, userId: 3, total: 75, status: 'shipped' }
  ]);
});

// GET order by ID
app.get('/api/orders/:id', (req, res) => {
  res.json({
    id: req.params.id,
    userId: Math.floor(Math.random() * 10) + 1,
    total: Math.floor(Math.random() * 500) + 50,
    status: ['pending', 'completed', 'shipped'][Math.floor(Math.random() * 3)]
  });
});

// POST create new order
app.post('/api/orders', (req, res) => {
  const newOrder = {
    id: Math.floor(Math.random() * 10000),
    userId: req.body.userId || 1,
    total: req.body.total || 0,
    status: 'pending',
    ...req.body
  };
  res.status(201).json(newOrder);
});

// PUT update order
app.put('/api/orders/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Order updated', data: req.body });
});

// DELETE order
app.delete('/api/orders/:id', (req, res) => {
  res.status(204).json({ message: `Order ${req.params.id} deleted` });
});

// ==================== ENDPOINT 9: CATEGORIES ====================
// GET all categories
app.get('/api/categories', (req, res) => {
  res.json([
    { id: 1, name: 'Electronics' },
    { id: 2, name: 'Clothing' },
    { id: 3, name: 'Books' },
    { id: 4, name: 'Home' },
    { id: 5, name: 'Sports' }
  ]);
});

// GET category by ID
app.get('/api/categories/:id', (req, res) => {
  const categories = ['Electronics', 'Clothing', 'Books', 'Home', 'Sports'];
  res.json({
    id: req.params.id,
    name: categories[req.params.id - 1] || 'Unknown'
  });
});

// POST create new category
app.post('/api/categories', (req, res) => {
  const newCategory = {
    id: Math.floor(Math.random() * 10000),
    name: req.body.name || 'New Category',
    ...req.body
  };
  res.status(201).json(newCategory);
});

// PUT update category
app.put('/api/categories/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Category updated', data: req.body });
});

// DELETE category
app.delete('/api/categories/:id', (req, res) => {
  res.status(204).json({ message: `Category ${req.params.id} deleted` });
});

// ==================== ENDPOINT 10: REVIEWS ====================
// GET all reviews
app.get('/api/reviews', async (req, res) => {
  try {
    const response = await fetch(`${PLACEHOLDER}/comments?_limit=10`);
    const comments = await response.json();
    const reviews = comments.map(item => ({
      id: item.id,
      productId: Math.floor(Math.random() * 10) + 1,
      rating: Math.floor(Math.random() * 5) + 1,
      comment: item.body
    }));
    res.json(reviews);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch reviews' });
  }
});

// GET review by ID
app.get('/api/reviews/:id', (req, res) => {
  res.json({
    id: req.params.id,
    productId: Math.floor(Math.random() * 10) + 1,
    rating: Math.floor(Math.random() * 5) + 1,
    comment: 'Great product!',
    userId: Math.floor(Math.random() * 10) + 1
  });
});

// POST create new review
app.post('/api/reviews', (req, res) => {
  const newReview = {
    id: Math.floor(Math.random() * 10000),
    productId: req.body.productId || 1,
    rating: req.body.rating || 5,
    comment: req.body.comment || 'Great!',
    ...req.body
  };
  res.status(201).json(newReview);
});

// PUT update review
app.put('/api/reviews/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Review updated', data: req.body });
});

// PATCH partially update review
app.patch('/api/reviews/:id', (req, res) => {
  res.json({ id: req.params.id, message: 'Review partially updated', data: req.body });
});

// DELETE review
app.delete('/api/reviews/:id', (req, res) => {
  res.status(204).json({ message: `Review ${req.params.id} deleted` });
});

// ==================== HEALTH CHECK ====================
app.get('/', (req, res) => {
  res.json({ 
    message: 'Express API Server Running!', 
    port: PORT,
    endpoints: [
      'GET/POST/PUT/PATCH/DELETE /api/users',
      'GET/POST/PUT/DELETE /api/posts',
      'GET/POST/PUT/DELETE /api/comments',
      'GET/POST/PUT/DELETE /api/albums',
      'GET/POST/PUT/DELETE /api/todos',
      'GET/POST/PUT/DELETE /api/photos',
      'GET/POST/PUT/PATCH/DELETE /api/products',
      'GET/POST/PUT/DELETE /api/orders',
      'GET/POST/PUT/DELETE /api/categories',
      'GET/POST/PUT/PATCH/DELETE /api/reviews'
    ]
  });
});

// Error handling
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Something went wrong!' });
});

// Start server
app.listen(PORT, () => {
  console.log(`🚀 Express server running on http://localhost:${PORT}`);
  console.log(`📡 Fetching data from ${PLACEHOLDER}`);
});
