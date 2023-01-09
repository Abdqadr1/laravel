import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import axios from 'axios';
import AdminLogin from './AdminLogin';
import AdminProfile from './Profile';

function App() {

    const http = axios.create({
        withCredentials: true,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With' : 'XMLHttpRequest'
        }
    })

    axios.get('/sanctum/csrf-cookie').then(response => {
        // Login...
    });

    return (
        <BrowserRouter>
            <Routes>
                <Route path='/react/account' element={<AdminProfile http={http} />} />
                <Route path='/react/login' element={<AdminLogin http={http} />} />
            </Routes>
        </BrowserRouter>
    )
}

export default App;


if (document.getElementById('react-div')) {
    const Index = ReactDOM.createRoot(document.getElementById("react-div"));

    Index.render(
        <React.StrictMode>
            <App/>
        </React.StrictMode>
    )
}