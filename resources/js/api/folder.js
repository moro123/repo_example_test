import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {

    show(id)
    {
        return axios.get('/api/folder/' + id); 
    },
        
    getFolders(data)
    {
        console.log({ API_GET_FOLDER_DATA: data } );
        return axios.post('/api/folder/get-folders', data);
    },
    
	store(data){
		let formData = this.jsonToFormData(data);

		return axios.post('/api/folder',
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


	updateFolder(data) {
		console.log( "UPDATE FOLDER" );
		let formData = this.jsonToFormData(data);

		return axios.post('/api/folder/update-folder',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},

    
    destroy(id) {
        console.log( "FOLDER API DESTROY" );
        return axios.delete('/api/folder/' + id,);
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
