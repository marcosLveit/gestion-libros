let todos = document.querySelector("#todos");
        let agregar = document.querySelector("#agregar");
        let content = document.querySelector("#content");

        const renderTable = (data) => {
            content.innerHTML = `<table class="w-2/3 text-center border border-collapse table-auto">
                                    <thead>
                                        <th class="border">ID</th>
                                        <th class="border">Nombre</th>
                                        <th class="border">Autor</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>`;
            let tbody = "";
            data.forEach(book => {
                tbody += `<tr>
                            <td class="border">${book.id}</td>
                            <td class="border">${book.name}</td>
                            <td class="border">${book.author}</td>
                            <td class="border"><a class="block w-1/2 p-px ml-4 text-xs text-center transition bg-indigo-500 rounded-md shadow-lg shadow-indigo-500/50 color-indigo-50" href="index.php?id=${book.id}">Ver</a></td>
                        </tr>`;
            });
            content.querySelector("tbody").innerHTML = tbody;
            let btns = content.querySelectorAll("tbody a");
            btns.forEach(btn => btn.addEventListener("click", handleBtn));
        }

        todos.addEventListener("click", async (e) => {
            e.preventDefault();
            let res = await fetch("index.php");
            let data = await res.json();

            renderTable(data);
        });

        const renderForm = () => {
            content.innerHTML = `
                <form class="flex flex-col justify-center w-2/3 gap-y-2">
                    <div class="flex flex-row justify-center w-full gap-x-2">
                        <label class="w-20" for="name">Nombre: </label>
                        <input required id="name" class="block px-2 py-1 bg-white border border-transparent rounded-md shadow ring-1 ring-slate-900/5 sm:text-sm placeholder:text-slate-400 text-slate-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-500" type="text" name="name">
                    </div>
                    <div class="flex flex-row justify-center w-full gap-x-2">
                        <label class="w-20" for="author">Autor: </label>
                        <input required id="author" class="block px-2 py-1 bg-white border border-transparent rounded-md shadow ring-1 ring-slate-900/5 sm:text-sm placeholder:text-slate-400 text-slate-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-500" type="text" name="author">
                    </div>
                    <button class="block px-4 py-2 mx-2 font-bold transition bg-blue-500 rounded-md shadow-lg shadow-blue-500/50 hover:shadow-blue-500/75 text-blue-50 hover:bg-blue-600" type="submit">Guardar</button>
                </form>
            `;
            let button = content.querySelector("button");
            button.addEventListener("click", handleSave);
        };

        const handleSave = async (e) => {
            e.preventDefault();
            let target = e.target;
            let formData = new FormData();
            let name = content.querySelector("[name='name']").value;
            let author = content.querySelector("[name='author']").value;
            if (!name || !author) {
                alert("Debe ingresar nombre y autor");
                return;
            }
            formData.append("name", name);
            formData.append("author", author);

            let res = await fetch("index.php", {
                method: "POST",
                body: formData
            });
            let data = await res.json();
            renderTable(data);
        };

        agregar.addEventListener("click", (e) => {
            e.preventDefault();

            renderForm();
        });

        const handleBtn = async (e) => {
            e.preventDefault();
            let target = e.target;
            let link = target.getAttribute("href");

            let res = await fetch(link);
            let data = await res.json();

            content.innerHTML = `
                <div class="flex flex-col justify-center w-2/3 text-center border rounded-md p-7">
                    <div class="p-2 min-w-fit">
                        Nombre: ${data.name}
                    </div>
                    <div class="p-2 min-w-fit">
                        Autor: ${data.author}
                    </div>
                    <div class="p-2">
                        <a href="index.php" data-id="${data.id}" class="block px-4 py-2 mx-2 font-bold transition bg-red-500 rounded-md shadow-lg shadow-red-500/50 hover:shadow-red-500/100 text-red-50 hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
            `;
            let btn = content.querySelector("a");
            btn.addEventListener("click", handleDelete);
        };

        const handleDelete = async (e) => {
            e.preventDefault();
            let target = e.target;
            let id = target.dataset.id;
            if(!confirm("Seguro que desea eliminar el libro?"))
                return;
            let res = await fetch(target.getAttribute("href"), {
                method: "DELETE",
                body: JSON.stringify({ id })
            });
            let data = await res.json();
            renderTable(data.data);

            alert(data.message);
        };