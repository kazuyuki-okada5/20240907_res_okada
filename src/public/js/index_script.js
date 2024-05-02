document.addEventListener('DOMContentLoaded', function() {
    const keywordInput = document.getElementById('keyword');
    keywordInput.setAttribute('placeholder', '🔍 キーワードを入力');
});

async function toggleFavorite(buttonElement) {
    const storeId = buttonElement.getAttribute('data-store-id');
    const icon = buttonElement.querySelector('.fa-heart');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/toggle-favorite/${storeId}`, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    });

    const data = await response.json();

    if(data.status === 'added') {
        icon.style.color = 'red';
    } else {
        icon.style.color = '#A9A9A9';
    }
}

function search() {
    const areaId = document.querySelector('#areaForm select[name="area_id"]').value;
    const genreId = document.querySelector('#genreForm select[name="genre_id"]').value;
    const keyword = document.getElementById('keyword').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let params = [];

    if (areaId) {
        params.push(`area_id=${areaId}`);
    }

    if (genreId) {
        params.push(`genre_id=${genreId}`);
    }

    if (keyword) {
        params.push(`keyword=${keyword}`);
    }

    const queryString = params.join('&');

    fetch(`/stores/search?${queryString}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        const content = container.querySelector('.store-container').innerHTML;
        document.querySelector('.store-container').innerHTML = content;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Enterキーを押したときに検索をトリガーする
document.getElementById('keyword').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        search();
        event.preventDefault(); // フォームの送信をキャンセル
    }
});

// フォームの変更時に検索を自動的に実行
document.getElementById('areaForm').addEventListener('change', search);
document.getElementById('genreForm').addEventListener('change', search);


