import axios from 'axios';



let api_key = process.env.MIX_TOM_KEY;




//# prendo gli input tramite id dal form di blade
let inputAddress = document.getElementById('address');

//# lista autocomplete address and cities
let addressList = document.getElementById('addressList')


//#parte da city

let address = "";

// % chiamata api città +  address
inputAddress.addEventListener('keyup', function() {

    if (this.value.length >= 4) {
        if (this.value.length % 2 == 0) {
        
            address = this.value;

            let query = encodeURI(address);
            axios.get(`https://api.tomtom.com/search/2/search/${query}.json?countrySet=IT`,{
                params: {
                    key: "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
                    typeahead: true,
                    limit: 3,
                    language:"it-IT"
                }
            })
            .then(function (response) {
                
                let list = response.data.results;
                console.log(list);

                //get list address with only name
                let addressesNames = getAddressName(list);
                //insert element inside the suggest
                writingAddressList(addressList, addressesNames);

                
            })
            .catch(function (error) {
                console.log(error); 
            })
            
        }    
    }
    
});



// % prendiamo lista degli address
function getAddressName(array) {
    let length = array.length;
    let names = [];

    for (let i = 0; i < length; i++) {

        if((array[i].address.municipality ===  undefined) || ( array[i].address.streetName === undefined) ) {

            array[i].address.municipality = "ricerca ";
            array[i].address.streetName = "ricerca";

            names.push(
                {
                    'street' : array[i].address.municipality + ", " + array[i].address.streetName ,
                    
                }
            );


        } else {
            names.push(
                {
                    'street' : array[i].address.municipality + ", " + array[i].address.streetName ,
                    
                }
            );
        }
    }

    return names;
};



// % FILL la lista degli address suggeriti DENTRO UL BLADE

function writingAddressList(list, array) {
    //svuoto
    list.innerHTML = '';
    

    array.forEach(element => {

        let newItem = document.createElement('li');
        newItem.innerHTML = element.street;
        list.appendChild(newItem);
        newItem.addEventListener('click', function(){
            inputAddress.value = this.textContent;
            list.innerHTML = '';
        })

    });
};

$(document).ready(function(){

    $('box-images input').change(function () {
    $('box-images p').text(this.files.length + " file(s) selected");
    });
});

