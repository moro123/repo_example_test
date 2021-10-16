import axios from 'axios';

export default 
{
    getMainSection(query)
    {
        return axios.post('/api/sections/get-main-section', query);
    },

}