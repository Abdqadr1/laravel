
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import {useState} from 'react';
import { useNavigate } from 'react-router-dom';

const AdminLogin = ({ http }) => {
    const [error, setError] = useState("");
    const navigate = useNavigate();
    const handleSubmit = e => {
        e.preventDefault();
        const formData = new FormData(e.target);
        http.post('/api/login', formData)
            .then((result) => {
                console.log(result);
                navigate("/account");
            })
            .catch((err) => {
                const res = err?.response;
                console.error(res);
                setError(res?.data?.message);
            });
    }
    
    return ( 
        <div>
            <Form className="p-3 border rounded" onSubmit={handleSubmit}>
                <h2 className="mb-3 text-center">Admin Login</h2>
                <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label>Email address</Form.Label>
                    <Form.Control name="email" type="email" placeholder="Enter email" />
                    <Form.Text id="error" className="text-danger">{ error }</Form.Text>
                </Form.Group>

                <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label>Password</Form.Label>
                    <Form.Control name="password" type="password" placeholder="Password" />
                </Form.Group>
                <Button variant="primary" type="submit">
                    Submit
                </Button>
            </Form>
        </div>
     );
}
 
export default AdminLogin;