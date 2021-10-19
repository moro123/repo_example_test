import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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


	updateSection(data){
		let formData = this.jsonToFormData(data);

        console.log("api update()");
        console.log( { formData: formData } );

		return axios.post('/api/sections/update-section',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},

    
    destroy(id) {
        return axios.delete('/api/sections/' + id,);
    },

    buildFormData(formData, data, parentKey) {
		if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
		  Object.keys(data).forEach(key => {
			this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
		  });
		} else {
		  const value = data == null ? '' : data;
	  
		  formData.append(parentKey, value);
		}
	},


    jsonToFormData(data) {
		const formData = new FormData();
		
		this.buildFormData(formData, data);
		
		return formData;
	}

}
