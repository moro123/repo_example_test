import axios from 'axios';

export default 
{
    signUp(data)
    {
        return axios.post('/api/signup', data);
    },

    login(data)
    {
        return axios.post('/api/login', data);
    },

    logout()
    {
        return axios.get('/api/logout');
    }

}