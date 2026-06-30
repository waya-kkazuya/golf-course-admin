// 検索フォームのプルダウン色制御
document.querySelectorAll('.search-select').forEach(function (select) {
    function updateColor() {
        select.style.color = select.value === '' ? '#999' : '#333';
    }
    updateColor();
    select.addEventListener('change', updateColor);
});

function toggleDeleteCheck(field, hasFile) {
    const checkbox = document.querySelector('#delete_' + field);
    if (!checkbox) return;
    if (hasFile) {
        checkbox.checked = false;
        checkbox.disabled = true;
    } else {
        checkbox.disabled = false;
    }
}

function toggleFileInput(field, isChecked) {
    const fileInput = document.querySelector('#' + field);
    if (isChecked) {
        fileInput.value = '';
        fileInput.disabled = true;
    } else {
        fileInput.disabled = false;
    }
}
