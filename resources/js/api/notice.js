import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {

    index()
    {
        return axios.get('/api/notice/'); 
    },

    show(id)
    {
        return axios.get('/api/notice/' + id); 
    },
        
	store(data){
		let formData = this.jsonToFormData(data);

		return axios.post('/api/notice',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},
    
	update(data, id) {
		data._method = 'PUT';

		let formData = this.jsonToFormData(data);
        

		return axios.post('/api/notice/' + id,
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},

    
    destroy(id) {
        return axios.delete('/api/notice/' + id,);
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
