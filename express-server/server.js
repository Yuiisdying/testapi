const express = require('express');
const axios = require('axios');
const app = express();
const PORT = 5000;

// JSONPlaceholder API
const PLACEHOLDER = 'https://jsonplaceholder.typicode.com';

// Middleware
app.use(express.json());

// Routes

// 1. GET all users
app.get('/api/users', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/users`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch users' });
  }
});

// 2. GET user by ID
app.get('/api/users/:id', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/users/${req.params.id}`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch user' });
  }
});

// 3. GET all comments
app.get('/api/comments', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/comments`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch comments' });
  }
});

// 4. GET all products (using photos as demo)
app.get('/api/products', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/photos?_limit=5`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch products' });
  }
});

// 5. GET all posts
app.get('/api/posts', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/posts`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch posts' });
  }
});

// 6. GET all albums
app.get('/api/albums', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/albums`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch albums' });
  }
});

// 7. GET all todos
app.get('/api/todos', async (req, res) => {
  try {
    const response = await axios.get(`${PLACEHOLDER}/todos`);
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch todos' });
  }
});

// Health check
app.get('/', (req, res) => {
  res.json({ 
    message: 'Express server is running!', 
    port: PORT,
    note: 'All data fetched from JSONPlaceholder'
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
