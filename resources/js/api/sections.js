import axios from 'axios';

export default 
{
    getSections(data)
    {
        return axios.post('/api/sections/get-sections', data);
    },
    
    store(data)
    {
        return axios.post('/api/sections', data);
    },

}
