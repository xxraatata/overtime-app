<div class="header">
    <img alt="Politeknik Astra Logo" src="https://www.polytechnic.astra.ac.id/storage/2024/03/Logogram-Astra.png">
    <div class="title">
        Employee Self Service
        <span class="subtitle">Politeknik Astra</span>
    </div>
    <div class="user">
        Hai, {{ Auth::user()->kry_name ?? 'Guest' }}
    </div>
</div> 