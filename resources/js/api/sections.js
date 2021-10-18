import axios from 'axios';

export default {

    show(id)
    {
        return axios.get('/api/sections/' + id); 
    },
        
    getSections(data)
    {
        return axios.post('/api/sections/get-sections', data);
    },
    
    store(data)
    {
        return axios.post('/api/sections', data);
    },
    
    update(data, id)
    {
        return axios.put('/api/sections/' + id, data);
    },
    
    destroy(id)
    {
        return axios.delete('/api/sections/' + id);
    },

}
