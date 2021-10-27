import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {

    show(id)
    {
        return axios.get('/api/profiles/' + id); 
    },
        
    getProfiles(data)
    {
        return axios.post('/api/profiles/get-profiles', data);
    },
    

	store(data){
		let formData = this.jsonToFormData(data);

		return axios.post('/api/profiles',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},
    
    // update(data, id)
    // {
    //     return axios.put('/api/sections/' + id, data);
    // },


	update(data) {
		console.log( { DATA: data } );
		let formData = this.jsonToFormData(data);

        console.log("api update()");
        console.log( { formData: formData } );

		return axios.post('/api/profiles/update-profile',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},

    
    destroy(id) {
        return axios.delete('/api/profiles/' + id,);
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
