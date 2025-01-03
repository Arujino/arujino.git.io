document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi accordion
    const accordions = document.querySelectorAll('.accordion');
    accordions.forEach(accordion => {
        accordion.addEventListener('click', function() {
            this.classList.toggle('active');
            const panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    });
});


function showFacilityDetail(roomId, event) {
    event.preventDefault();
    console.log('showFacilityDetail called for room:', roomId); // Debug log
    
    const facilityInfo = document.querySelector('.facility-info');
    const pelaporanView = document.querySelector('.pelaporan-view');
    const placeholderText = document.querySelector('.placeholder-text');
    
    if (facilityInfo && pelaporanView && placeholderText) {
        placeholderText.style.display = 'none';
        pelaporanView.style.display = 'none';
        facilityInfo.style.display = 'block';
        document.getElementById('roomNumber').textContent = roomId;
        
        fetch(`get_facility.php?ruangan=${roomId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }
                
                // Update nilai-nilai fasilitas
                document.getElementById('luas-ruangan').textContent = data.luas_ruangan || '-';
                document.getElementById('kursi-meja').textContent = data.kursi_dan_meja || '-';
                document.getElementById('papan-tulis').textContent = data.papan_tulis || '-';
                document.getElementById('spidol').textContent = data.spidol || '-';
                document.getElementById('penghapus').textContent = data.penghapus || '-';
                document.getElementById('lcd').textContent = data.lcd || '-';
                document.getElementById('kipas').textContent = data.kipas || '-';
                document.getElementById('ac').textContent = data.ac || '-';
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('Required elements not found');
    }
}