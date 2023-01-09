import { useEffect, useState } from "react";
import ListGroup from 'react-bootstrap/ListGroup';

const AdminProfile = ({ http }) => {
    const [user, setUser] = useState({});
    useEffect(() => {
        const abortController = new AbortController();
      http.get('/api/user', { signal: abortController.signal })
            .then((result) => {
                console.log(result.data);
                setUser(result.data);
            })
            .catch((err) => {
                const res = err?.response;
            });
      return () => {
          abortController.abort();
      }
    }, [])
    
    return (
        <div>
            <h2 className="my-2 text-center">Admin Profile</h2>
            <ListGroup as="ol" numbered>
                <ListGroup.Item as="li"><b>Name: </b> { user.name }</ListGroup.Item>
                <ListGroup.Item as="li"><b>Email: </b>{ user.email }</ListGroup.Item>
                <ListGroup.Item as="li"><b>Create At: </b>{ user.created_at }</ListGroup.Item>
            </ListGroup>

        </div>
    );
}
 
export default AdminProfile;