export function formatCPF(cpf) {
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

export function formatBirthDate(data) {
    return new Date(data).toLocaleDateString("pt-BR");
}

export function formatCPFInput(value) {
    const digits = value.replace(/\D/g, "");
    return digits.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

export function formatBirthDateInput(input) {
    input = input.replace(/\D/g, "");

    input = input.replace(/^(\d{2})(\d{0,2})/, "$1/$2");
    input = input.replace(/^(\d{2}\/\d{2})(\d{0,4})/, "$1/$2");

    return input;
}
