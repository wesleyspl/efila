function speak() {
  const textArea = document.getElementById('senha-atual');
  const text = textArea.value;

  if ('speechSynthesis' in window) {
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'pt-BR';

    speechSynthesis.speak(utterance);
  } else {
    alert('Desculpe, seu navegador não suporta a API Web Speech.');
  }
}
