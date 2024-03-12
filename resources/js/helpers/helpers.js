export function formatCPF(cpf) {
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

export function formatBirthDate(data) {
    return new Date(data).toLocaleDateString('pt-BR');
}
