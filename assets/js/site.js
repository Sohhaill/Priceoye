const swiper3 = new Swiper('.season_maingrid', {
       
    slidesPerView: 4.5,
    spaceBetween: 15,
    grid: {
      rows: 2,
      fill: 'row'
    },
navigation: {
nextEl: '.season_maingridnav2',
prevEl: '.season_maingridav1',
},
breakpoints: {
  300:{
    slidesPerView: 1.5,
    spaceBetween: 15,
  },
  640: {
    slidesPerView: 2.5,
    spaceBetween: 15,
  },
  768: {
    slidesPerView: 3.5,
    spaceBetween: 15,
  },
  1024: {
    slidesPerView: 4.5,
    spaceBetween: 15,
  },
},

});



// product gallery sldier




const swiper4 = new Swiper('.product_galleryslider', {
       
       slidesPerView: 1,
       spaceBetween: 15,
       
     navigation: {
     nextEl: '.productnav2',
     prevEl: '.productnav1',
     },
     pagination :{
      el: ".gallerypagination",
      clickable: true,
      type: 'fraction'
     }
     });

     document.querySelectorAll('.variant_color, .singlevariant_color').forEach(variant => {
      variant.addEventListener('click', () => {
        const variantImageUrl = variant.getAttribute('data-image');
  
      
        const slides = document.querySelectorAll('.product_galleryslider .swiper-slide');
        slides.forEach((slide, index) => {
          const productImage = slide.querySelector('img.product_images');
          if (productImage && productImage.src === variantImageUrl) {
            swiper4.slideTo(index); 
          }
        });
  
      
      });
    });

const swiper = new Swiper('.cattop', {

    slidesPerView: 8,
    
    
    
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      300:{
        slidesPerView: 4,
      },
      640: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 6,
      },
      1024: {
        slidesPerView: 8,
      },
    },
    });

    const swiper2 = new Swiper('.bannerswiper', {

        slidesPerView: 1,
        loop:true,
        
        
        navigation: {
          nextEl: '.bannernav2',
          prevEl: '.bannernav1',
        },
       
        
        
        });

const dropdownbutton = document.querySelector("#ham");
const menuslider = document.querySelector(".menuslider");
const hamburgers = document.querySelector(".hamburgers");
const blue_bg = document.querySelector(".blue_bg");
const menu_below = document.querySelector(".menu_below");
const closebtn = document.querySelector(".close-icon");


dropdownbutton.addEventListener("click", ()=>{

menuslider.classList.toggle("opacity-0");
menuslider.classList.toggle("opacity-100");
// menuslider.classList.toggle("w-[0px]");
// menuslider.classList.toggle("w-full");
hamburgers.classList.toggle("w-[0px]");
hamburgers.classList.toggle("w-[358px]")
blue_bg.classList.toggle("py-[0px]");
blue_bg.classList.toggle("py-[60px]");
blue_bg.classList.toggle("px-[0px]");
blue_bg.classList.toggle("px-[30px]");
menu_below.classList.toggle("p-[0px]");
menu_below.classList.toggle("p-[30px]");
});

closebtn.addEventListener("click", ()=>{

  menuslider.classList.toggle("opacity-0");
  menuslider.classList.toggle("opacity-100")
  hamburgers.classList.toggle("w-[0px]");
  hamburgers.classList.toggle("w-[358px]")
  blue_bg.classList.toggle("py-[0px]");
  blue_bg.classList.toggle("py-[60px]");
  blue_bg.classList.toggle("px-[0px]");
  blue_bg.classList.toggle("px-[30px]");
  menu_below.classList.toggle("p-[0px]");
  menu_below.classList.toggle("p-[30px]");
  });

// For Color And Varient Storage

    function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

const hiddenstorage = document.querySelector('.hiddenstorage');

  document.querySelectorAll('.select-color').forEach(function(element) {
    element.addEventListener('click', function() {
        var selectedColor = this.getAttribute('data-color');
       
        hiddenstorage.classList.remove("hidden");

        document.querySelectorAll('.storage_options').forEach(function(storageElement) {
            storageElement.classList.add('hidden');
        });
        document.querySelector('.storage_options[data-color="' + selectedColor + '"]').classList.remove('hidden');

        document.querySelectorAll('textcolorchange');

        document.querySelectorAll('.select-color').forEach(function(el) {
            el.classList.remove('!border-[#48afff]', 'border-[2px]');
            el.classList.add('border-[#d9d9d9]');
        });
        this.classList.add('!border-[#48afff]', 'border-[2px]');
    });
});

window.addEventListener('DOMContentLoaded', function() {
    var firstColorElement = document.querySelector('.select-color');
    if (firstColorElement) {
        firstColorElement.click();
    }
});


document.querySelectorAll('.select-storage').forEach(function(element) {
    element.addEventListener('click', function() {
        var variantId = this.getAttribute('data-variant_id');
        var storage = this.getAttribute('data-storage');
        var salePrice = this.getAttribute('data-sale_price');
        var regularPrice = this.getAttribute('data-regular_price');
        var attributes = JSON.parse(this.getAttribute('data-attributes'));
        var getstockstatus = this.getAttribute('stock-status');
        var stock_status= document.getElementById('stock-status');
                
        if (getstockstatus && getstockstatus.trim() !== "") {
    stock_status.innerText = 'Out of stock'; 
    stock_status.style.color = 'red'; 
} else {
    stock_status.innerText = 'In stock'; 
    stock_status.style.color = 'green';
}
       
        document.getElementById('selected-variation-id').value = variantId;

        document.getElementById('selectedsaleprice').innerHTML =  (numberWithCommas(salePrice));
       
        document.getElementById('selectedregularprice').innerHTML =(numberWithCommas(regularPrice));
        var attrContainer = document.getElementById('attributes-container');
        attrContainer.innerHTML = '';

        for (var attrName in attributes) {
            if (attributes.hasOwnProperty(attrName)) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'attribute_' + attrName;
                input.value = attributes[attrName];
                attrContainer.appendChild(input);
            }
        }

     

        document.getElementById('add-to-cart-button').classList.remove('hidden');

        document.querySelectorAll('.select-storage').forEach(function(el) {
            el.classList.remove('!border-[#48afff]', 'border-[2px]');
            el.classList.add('border-[#d9d9d9]');
        });
        this.classList.add('!border-[#48afff]', 'border-[2px]');
       

    });
    window.addEventListener('DOMContentLoaded', function() {
    var firstColorElements = document.querySelector('.select-storage');
    if (firstColorElements) {
        firstColorElements.click();
    }
});
});
document.getElementById('add-to-cart-button').addEventListener('click', function() {
    var productId = document.querySelector('input[name="product_id"]').value;
    var variationId = document.getElementById('selected-variation-id').value;
    var quantity = 1;

    var formData = new FormData();
    formData.append('action', 'woocommerce_ajax_add_to_cart');
    formData.append('product_id', productId);
    formData.append('variation_id', variationId);
    formData.append('quantity', quantity);

    fetch(wc_add_to_cart_params.ajax_url, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
    })
    .then(response => response.json())
    .then(response => {
        if (response && response.error) {
            alert(response.error || 'Something went wrong!');
        } else {
            const message = document.getElementById('cart-message');
            const messageupper = document.getElementById('cart_messagewrap');
            const messagebtn = document.getElementById('viewcartajax');
            message.classList.remove('opacity-0');
    message.classList.add('opacity-100');
    messageupper.classList.remove('opacity-0');
    messageupper.classList.add('opacity-100');

    messagebtn.classList.remove('opacity-0');
    messagebtn.classList.add('opacity-100');


    setTimeout(() => {
        message.classList.remove('opacity-100');
        message.classList.add('opacity-0');
        messageupper.classList.remove('opacity-100');
        messageupper.classList.add('opacity-0');
        messagebtn.classList.remove('opacity-100');
        messagebtn.classList.add('opacity-0');
    }, 6000);
        }
    })
    .catch(error => {
        console.error('Add to Cart Error:', error);
        alert('Error adding item to cart.');
    });
});

// For Single Varient Color


    window.addEventListener('DOMContentLoaded', function() {
    var firstColorElement = document.querySelector('.select-color');
    if (firstColorElement) {
        firstColorElement.click();
    }
});

    document.querySelectorAll('.singlevariant_color').forEach(function(element) {
    element.addEventListener('click', function() {
        var variantId = this.getAttribute('single-varientid');
        // var storage = this.getAttribute('data-storage');
        var salePrice = this.getAttribute('single-sale_price');
        var regularPrice = this.getAttribute('single-regular_price');
        var getstockstatus = this.getAttribute('stock-status');
        var stock_status= document.getElementById('stock-status');
        document.getElementById('selected-variation-id').value = variantId;
        
        if (getstockstatus && getstockstatus.trim() !== "") {
    stock_status.innerText = 'Out of stock'; 
    stock_status.style.color = 'red'; 
} else {
    stock_status.innerText = 'In stock'; 
    stock_status.style.color = 'green';
}

        document.getElementById('singleselectedsaleprice').innerHTML = (numberWithCommas(salePrice));
        document.getElementById('singleselectedregularprice').innerHTML = (numberWithCommas(regularPrice));
        var attrContainer = document.getElementById('attributes-container');
        attrContainer.innerHTML = '';

      

        document.getElementById('add-to-cart-button').classList.remove('hidden');

        document.querySelectorAll('.singlevariant_color').forEach(function(el) {
            el.classList.remove('!border-[#48afff]', 'border-[2px]');
            el.classList.add('border-[#d9d9d9]');
        });
        this.classList.add('!border-[#48afff]', 'border-[2px]');
       

    });
    window.addEventListener('DOMContentLoaded', function() {
    var firstColorElements = document.querySelector('.singlevariant_color');
    if (firstColorElements) {
        firstColorElements.click();
    }
});
});
document.getElementById('add-to-cart-button').addEventListener('click', function() {
    var productId = document.querySelector('input[name="product_id"]').value;
    var variationId = document.getElementById('selected-variation-id').value;
    var quantity = 1;

    var formData = new FormData();
    formData.append('action', 'woocommerce_ajax_add_to_cart');
    formData.append('product_id', productId);
    formData.append('variation_id', variationId);
    formData.append('quantity', quantity);

    fetch(wc_add_to_cart_params.ajax_url, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
    })
    .then(response => response.json())
    .then(response => {
        if (response && response.error) {
            alert(response.error || 'Something went wrong!');
        } else {
          const message = document.getElementById('cart-message');
          const messageupper = document.getElementById('cart_messagewrap');
          const messagebtn = document.getElementById('viewcartajax');
          message.classList.remove('opacity-0');
  message.classList.add('opacity-100');
  messageupper.classList.remove('opacity-0');
  messageupper.classList.add('opacity-100');

  messagebtn.classList.remove('opacity-0');
  messagebtn.classList.add('opacity-100');


  setTimeout(() => {
      message.classList.remove('opacity-100');
      message.classList.add('opacity-0');
      messageupper.classList.remove('opacity-100');
      messageupper.classList.add('opacity-0');
      messagebtn.classList.remove('opacity-100');
      messagebtn.classList.add('opacity-0');
  }, 6000);
      }
    })
    .catch(error => {
        console.error('Add to Cart Error:', error);
        alert('Error adding item to cart.');
    });
});


