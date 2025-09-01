
document.addEventListener('DOMContentLoaded', function (e) {
    
    jQuery('.select2').select2();
    const teamsSelect2 = jQuery('#personnelForm_idUserTeam').select2({
        ajax: {
            url: '/api/index.php/v1/params?opt=seateam',
            dataType: 'json',
            delay: 400,
            data: function (params) {
                ret = {
                    term: params.term,
                    pageTo: params.page || 1
                };

                return ret;
            },

            processResults: function (response) {
                const results = response.data.map((item) => {
                    return {id: item.attributes.id, text: item.attributes.name, image: item.attributes.image};
                });

                return {
                    results: results,
                    pagination: {
                        more: response.links.next ? true : false
                    }
                };
            }
        },
        templateResult: function (data) {
            const image = getImage(data.image);
            return jQuery(candidateInnerHTML(data.id, data.text, image));
        },
        templateSelection: function (data) {
           const image = data.element.dataset.image ? data.element.dataset.image:
                   getImage(data.image);
            return jQuery(candidateInnerHTML(data.id, data.text, image, true));
        }
               
    });



    jQuery.ajax({
        type: 'GET',
        url: '/api/index.php/v1/params?opt=stoteam&term=' + document.getElementById('personnelForm_id').value
    }).then(function (data) {
        const select2Data = data.data.map(item => dataO(item.attributes.id, item.attributes.name, item.attributes.image, true));
        for (const item of select2Data) {
            const text = item.text;
            const option = new Option(text, item.id, true, true);
            option.dataset.image = getImage(item.image);
            teamsSelect2.append(option).trigger('change');
        }


    });

    const getImage = (image2Check) => {
        if (image2Check && image2Check !== '')
            return image2Check;
        return "images/elgjobs/users/default_user.jpg";
    };

    const candidateInnerHTML = (id, name, image, createLink = false) => {
        const img = getImage(image);
        if (createLink) 
        {
            return `<span class="userListTile" id="${id}" ><span class="userListTileImg"><img src="/${img}" ></span><span class="userListTileTxt"><a href="epexergasia-prosopikou.html?id=${id}" > ${name}</a></span></span>`;
        }
        return `<span class="userListTile" id="${id}" ><span class="userListTileImg"><img src="/${img}" ></span><span class="userListTileTxt">${name}</span></span>`;
    };
    
    
    const dataO = (id, text, image, selected) => {
        return {
            id: id, 
            text: text,
            image:  image && image !== '' ? image : "images/elgjobs/users/default_user.jpg",
            selected: selected
        };
    };
});