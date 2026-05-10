
document.title ='fathan haha'
const body = document.body
const btn1 = document.getElementById('btn1')
const btn2 = document.getElementById('btn2')

const defaultText = 'KLIK SAYA'
btn1.textContent = defaultText
btn2.textContent= defaultText

btn1.style.border = 'none'

function kliktombol() {
    btn1.style.background = 'aqua'
    const newText = document.createElement ('p')
    newText.textContent = 'nah tepicik'
    body.append(newText)
}

function gantiText() {
    btn1.textContent = 'fafafa'
}

function gantiApa() {
    btn1.textContent = defaultText
}

function satu() {
    btn2.style.border = 'none'
    const tekshanyar = document.createElement('h1')
    tekshanyar.id = 'tekshanyar'
    tekshanyar.textContent = 'mantaapp'
    body.append (tekshanyar)

}

function dua(){
    btn2.textContent = 'beubah'
}

function tiga() {
    btn2.textContent = defaultText
    const tekshanyar = document.getElementById ('tekshanyar')
    if (tekshanyar) {
        tekshanyar.style.color = 'red'
    }
}