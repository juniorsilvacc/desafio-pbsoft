export function validateBirthDate(dateString) {
    const pattern = /^\d{2}\/\d{2}\/\d{4}$/;

    if (!pattern.test(dateString)) {
        return false;
    }

    const parts = dateString.split("/");
    const day = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10);
    const year = parseInt(parts[2], 10);

    if (year < 1900 || year > new Date().getFullYear()) {
        return false;
    }

    if (month < 1 || month > 12) {
        return false;
    }

    const maxDay = new Date(year, month, 0).getDate();

    if (day < 1 || day > maxDay) {
        return false;
    }

    return true;
}

export function validateCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11) {
        return false;
    }

    if (/^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    let sum = 0;
    let remainder;
    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf[i - 1]) * (11 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) {
        remainder = 0;
    }
    if (remainder !== parseInt(cpf[9])) {
        return false;
    }

    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf[i - 1]) * (12 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) {
        remainder = 0;
    }
    if (remainder !== parseInt(cpf[10])) {
        return false;
    }

    return true;
}

