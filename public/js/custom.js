document.addEventListener('DOMContentLoaded', function() {
    const radioBtn = document.getElementById('married');
    const radioBtn2 = document.getElementById('unmarried');
    const labelBtn = document.getElementById('mrg_date_label');
    const divradio = document.getElementById('mrg_date_div');
    
    const mariageDateInput = document.getElementById('mariage_date');

    radioBtn.addEventListener('click', function() {
        if (this.checked) {
            mariageDateInput.style.display = 'block';
            labelBtn.style.display = 'block';
            divradio.style.display = 'flex';
        } 
    });

    radioBtn2.addEventListener('click', function() {
        if (this.checked) {
            mariageDateInput.style.display = 'none';
            labelBtn.style.display = 'none';
            divradio.style.display = 'none';
            
        } 
    });

   
});