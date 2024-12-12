// Modal Functions
function openModal(action) {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('modal-action').innerText = action;
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function submitNotes() {
    var notes = document.getElementById('notes').value;
    var action = document.getElementById('modal-action').innerText;
    if (notes.trim() !== "") {
        alert("Catatan untuk " + action + ": " + notes);
        closeModal();
    } else {
        alert("Catatan tidak boleh kosong.");
    }
}

// Filter Functions
function toggleFilter() {
    var filterPopup = document.getElementById('filterPopup');
    filterPopup.style.display = filterPopup.style.display === 'none' ? 'block' : 'none';
}

function applyFilter() {
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
    var status = document.getElementById('status').value;
    
    console.log("Filter applied with:", {
        startDate: startDate,
        endDate: endDate,
        status: status
    });
    
    toggleFilter();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Filter popup click outside
    document.addEventListener('click', function(event) {
        var filterPopup = document.getElementById('filterPopup');
        var filterBtn = document.getElementById('filterBtn');
        if (filterPopup && !filterPopup.contains(event.target) && event.target !== filterBtn) {
            filterPopup.style.display = 'none';
        }
    });

    // ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Click outside modal to close
    window.onclick = function(event) {
        var modal = document.getElementById('modal');
        if (event.target == modal) {
            closeModal();
        }
    };
}); 