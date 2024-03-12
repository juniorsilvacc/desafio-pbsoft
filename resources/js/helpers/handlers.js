import { notify } from "@kyvg/vue3-notification";

export function handleImageUpload(event, client) {
    const files = event.target.files;

    if (files.length > 0) {
        const file = files[0];
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"]; // Adicione outros tipos de imagem, se necessário

        if (allowedTypes.includes(file.type)) {
            client.photo = file;
        } else {
            // Limpar o campo de foto e notificar o usuário sobre o tipo de arquivo não suportado
            client.photo = null;
            notify({
                title: "Erro ao carregar imagem",
                text: "Por favor, selecione um arquivo de imagem válido (JPEG, PNG, GIF).",
                type: "error",
            });
        }
    } else {
        client.photo = null;
    }
}

export function handleErrors(error, router) {
    let msgError = "Falha na requisição";

    if (error.response && error.response.status === 422) {
        if (error.response.data && error.response.data.errors) {
            const validationErrors = error.response.data.errors;

            const formattedErrors = Object.values(validationErrors)
                .flat()
                .join(", ");

            msgError = `${formattedErrors}`;
        }
    } else if (error.response && error.response.status === 404) {
        msgError = "Cliente não encontrada";
        router.push({ name: "admin.clients" });
    }

    notify({
        title: "Falha ao processar cliente",
        text: msgError,
        type: "error",
    });
}
