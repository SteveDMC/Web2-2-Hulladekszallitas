class Naptar {
    constructor(selector) {
        this.wrapper = $(selector);
    }
    kirajzol(hetek) {
        this.wrapper.html('');
        for (const het of hetek) {
            this.wrapper.append(
                this.getHetHtml(het)
            );
        }
    }

    getHetHtml(het) {
        let napok = '';
        for (const nap of het) {
            napok += this.getNapHtml(nap);
        }
        return `<tr>${napok}</tr>`;
    }
    getNapHtml(nap) {
        return `<td class="nap">${nap.nap}</td>`;
    }
}
let naptar = null;

// DOM ready
$(() => {
    naptar = new Naptar('#naptar', []);
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
        const {hetek} = await getData(szolgid, ev, honap);
        naptar.kirajzol(hetek);
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