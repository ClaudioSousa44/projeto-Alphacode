export const getUsuarios = async () => {
  const url = `http://localhost/back-end-alphacode/index.php/v1/usuarios`;
  const response = await fetch(url);
  const dado = await response.json();
  return dado;
};

export function deleteAluno(id) {
  const url = `http://localhost/back-end-alphacode/index.php/v1/usuarios/${id}`;
  const options = {
    method: "DELETE",
  };

  fetch(url, options);
}

export const createUsuario = async ( usuario ) => {
    const url = "http://localhost/back-end-alphacode/index.php/v1/usuarios";
    const options = {
      headers: {
        "Content-Type": "application/json",
      },
      method: "POST",
      body: JSON.stringify(usuario),
    };

      fetch(url, options)
        .then((response) => {
          if (response.ok) {
            
            return response.json();
          } else {
            throw new Error("Erro ao fazer a solicitação");
          }
        })
        .then((data) => {
          console.log(data);
        })
        .catch((error) => {
          console.error(error);
        });
  }

  export const updateUsuario = async (id, usuario) => {
    const url = `http://localhost/back-end-alphacode/index.php/v1/usuarios/${id}`;
    const options = {
      headers: {
        "Content-Type": "application/json",
      },
      method: "PUT",
      body: JSON.stringify(usuario),
    };

    fetch(url, options)
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error("Erro ao fazer a solicitação");
        }
      })
      .then((data) => {
        console.log(data);
      })
      .catch((error) => {
        console.error(error);
      });
  };




  