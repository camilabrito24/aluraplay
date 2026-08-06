class FlashMessage{
    constructor() {
        this.init();
    }

    init(){
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('sucesso');

        if(status){
            this.showMessage(status);
            this.clearUrl();
        }
    }

    showMessage(status){
        const messages = {
            "1" : "🗑️ Vídeo removido com sucesso!",
            "2" : "✅ Vídeo cadastrado com sucesso!",
            "3" : "🔃 Vídeo atualizado com sucesso!"
        };

        const message = messages[status] || "❌ Ops! Algo deu errado na operação.";
        alert(message);
    }

    clearUrl(){
        window.history.replaceState(null, null, window.location.pathname);
    }
}
document.addEventListener('DOMContentLoaded', () =>{
    new FlashMessage();
});