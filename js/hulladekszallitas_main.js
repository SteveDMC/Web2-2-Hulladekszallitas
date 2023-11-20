class Naptar {
    constructor(selector) {
        this.wrapper = $(selector);
    }
    kirajzol(hetek, szallitasi_napok, igenyek) {
        this.szallitasi_napok = szallitasi_napok;
        this.igenyek = igenyek;
        this.wrapper.html('');
        for (const het of hetek) {
            this.wrapper.append(
                this.getHetHtml(het)
            );
        }
        this.wrapper.css('visibility', 'visible');
    }
    getHetHtml(het) {
        let napok = '';
        for (const nap of het) {
            napok += this.getNapHtml(nap);
        }
        return napok;//`<div class="het">${napok}</div>`;
    }
    getNapHtml(nap) {
        const class_list = ['nap'];
        if (this.szallitasi_napok.map(sz => sz.datum).includes(nap.datum)) {
            class_list.push('szallitas');
        }
        const content = `<span>${nap.nap || '&nbsp;'}</span><div>${this.getIgenyekHtml(nap)}</div>`;
        return `<div class="${class_list.join(' ')}">${content}</div>`;
    }
    getIgenyekHtml(nap) {
        const igeny = this.igenyek.filter(igeny => igeny.igeny === nap.datum);
        if (!igeny.length) {
            return '';
        }
        return `<img src="${IMAGES_ROOT}szemet.svg"/>`.repeat(igeny[0].mennyiseg);
    }
}

class Grafikon {
    constructor(selector) {
        this.ctx = $(selector).get(0);
        this.chart = null;
    }
    kirajzol(mennyisegek) {
        this.chart?.destroy();
        this.chart = new Chart(this.ctx, {
            type: 'doughnut',
            data: {
                labels: mennyisegek.map(adat => adat.tipus),
                datasets: [{
                    data: mennyisegek.map(adat => adat.mennyiseg),
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Havi mennyiségek megoszlása hulladék típusonként',
                    }
                }
            }
        });
    }
}

let naptar = grafikon = null;

document.addEventListener("DOMContentLoaded", () => {
    naptar = new Naptar('#naptar');
    grafikon = new Grafikon('#grafikon');
    addEventHandlers();
});

function addEventHandlers() {
    $('#szuro').on('click', 'button', async function (e) {
        const szolgid = $('#szolgid').val();
        const ev = $('#ev').val();
        const honap = $('#honap').val();

        if (!(szolgid && ev && honap)) {
            return;
        }

        $(this).prop('disabled', true);
        const {hetek, szallitasi_napok, igenyek, mennyisegek} = await getData(szolgid, ev, honap);
        naptar.kirajzol(hetek, szallitasi_napok, igenyek);
        grafikon.kirajzol(mennyisegek);
        $(this).prop('disabled', false);
    })
}

async function getData(szolgid, ev, honap) {
    return await $.ajax({
        url: AJAX_URL,
        data: {
            szolgid: szolgid,
            ev: ev,
            honap: honap,
        },
    });
}