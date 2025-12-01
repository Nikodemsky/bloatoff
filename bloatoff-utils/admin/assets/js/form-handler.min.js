/** Number inputs + checkbox handle  **/
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bou-number-block').forEach(block => {
        const checkbox = block.querySelector('input[type="checkbox"]');
        const numberInput = block.querySelector('input[type="number"]');
        
        if (checkbox && numberInput) {
            numberInput.disabled = !checkbox.checked;
            
            checkbox.addEventListener('change', (e) => {
                numberInput.disabled = !e.target.checked;
            });
        }
    });
});