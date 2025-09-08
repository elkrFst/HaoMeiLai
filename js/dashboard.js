// Navegación interna
function showSection(section) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    const target = document.getElementById(section + '-section');
    if (target) target.classList.add('active');
    // Marcar el menú activo
    document.querySelectorAll('.menu li').forEach(li => li.classList.remove('active'));
    if (section !== 'detalle') {
        const menuItems = {
            'dashboard': 0,
            'productos': 1,
            'trabajadores': 2
        };
        const idx = menuItems[section];
        if (typeof idx !== 'undefined') {
            document.querySelectorAll('.menu li')[idx].classList.add('active');
        }
    }
}

// Tarjetas Dashboard
function showDetail(tipo) {
    showSection('detalle');
    const detalle = document.getElementById('detalle-content');
    detalle.innerHTML = '<h2>Cargando...</h2>';
    fetch(`../Admin/dashboard_detalle.php?tipo=${tipo}`)
        .then(res => res.text())
        .then(html => detalle.innerHTML = html);
}

// Productos
let productos = [];
let paginaActual = 1;
const productosPorPagina = 8;
let modalBg = null;

function cargarProductos() {
    fetch('../Admin/productos.php?action=list')
        .then(res => res.json())
        .then(data => {
            productos = data;
            mostrarTablaProductos();
        });
}

function mostrarTablaProductos() {
    const inicio = (paginaActual - 1) * productosPorPagina;
    const fin = inicio + productosPorPagina;
    const paginados = productos.slice(inicio, fin);
    let html = '<table><tr><th>Producto</th><th>Precio</th><th>Stock</th><th>Ventas</th><th>Acciones</th></tr>';
    paginados.forEach(p => {
        html += `<tr>
            <td>${p.producto}</td>
            <td>$${p.precio}</td>
            <td>${p.stock}</td>
            <td>${p.ventas}</td>
            <td>
                <button class='btn-editar' onclick='editarProducto(${p.id})'>Editar</button>
                <button class='btn-eliminar' onclick='eliminarProducto(${p.id})'>Eliminar</button>
            </td>
        </tr>`;
    });
    html += '</table>';
    // Paginación
    const totalPaginas = Math.ceil(productos.length / productosPorPagina);
    html += '<div class="paginacion">';
    for (let i = 1; i <= totalPaginas; i++) {
        html += `<button onclick="irPagina(${i})"${i === paginaActual ? ' class="active"' : ''}>${i}</button>`;
    }
    html += '</div>';
    document.getElementById('productos-table-container').innerHTML = html;
}

function irPagina(num) {
    paginaActual = num;
    mostrarTablaProductos();
}

function showAddProducto() {
    showModal(`
        <h3>Agregar producto</h3>
        <form id='form-add-producto'>
            <input type="text" name="producto" placeholder="Nombre" required><br>
            <input type="number" name="precio" placeholder="Precio" required step="0.01"><br>
            <input type="number" name="stock" placeholder="Stock" required><br>
            <div class='modal-actions'>
                <button type="submit" class="btn-agregar">Guardar</button>
                <button type="button" class="btn-eliminar" onclick="closeModal()">Cancelar</button>
            </div>
        </form>
    `);
    document.getElementById('form-add-producto').onsubmit = agregarProducto;
}
function cancelarAddProducto() {
    closeModal();
}
function agregarProducto(e) {
    e.preventDefault();
    const form = e.target;
    const datos = new FormData(form);
    fetch('../Admin/productos.php?action=add', {
        method: 'POST',
        body: datos
    }).then(res => res.json())
      .then(r => {
        if (r.success) {
            cargarProductos();
            closeModal();
        } else {
            alert('Error al agregar producto');
        }
    });
}
function editarProducto(id) {
    console.log('Editar producto:', id);
    const prod = productos.find(p => p.id == id);
    showModal(`
        <h3>Editar producto</h3>
        <form id='form-edit-producto'>
            <input type="text" name="producto" value="${prod.producto}" required><br>
            <input type="number" name="precio" value="${prod.precio}" required step="0.01"><br>
            <input type="number" name="stock" value="${prod.stock}" required><br>
            <div class='modal-actions'>
                <button type="submit" class="btn-editar">Guardar</button>
                <button type="button" class="btn-eliminar" onclick="closeModal()">Cancelar</button>
            </div>
        </form>
    `);
    document.getElementById('form-edit-producto').onsubmit = function(e) { guardarEdicionProducto(e, id); };
}
function guardarEdicionProducto(e, id) {
    e.preventDefault();
    const form = e.target;
    const datos = new FormData(form);
    datos.append('id', id);
    fetch('../Admin/productos.php?action=edit', {
        method: 'POST',
        body: datos
    }).then(res => res.json())
      .then(r => {
        if (r.success) {
            cargarProductos();
            closeModal();
        } else {
            alert('Error al editar producto');
        }
    });
}
function eliminarProducto(id) {
    showModal(`
        <h3>¿Realmente quieres borrar el producto?</h3>
        <div class='modal-actions'>
            <button class='btn-eliminar' onclick='confirmarEliminarProducto(${id})'>Sí, borrar</button>
            <button class='btn-editar' onclick='closeModal()'>Cancelar</button>
        </div>
    `);
}

function confirmarEliminarProducto(id) {
    fetch(`../Admin/productos.php?action=delete&id=${id}`)
        .then(res => res.json())
        .then(r => {
            if (r.success) {
                cargarProductos();
                closeModal();
            } else {
                alert('Error al eliminar producto');
            }
        });
}
// Inicialización
window.onload = function() {
    cargarProductos();
    showSection('dashboard');
}

// Modal helpers
function showModal(html) {
    closeModal();
    modalBg = document.createElement('div');
    modalBg.className = 'modal-bg';
    modalBg.innerHTML = `<div class='modal'>${html}</div>`;
    document.body.appendChild(modalBg);
}
function closeModal() {
    if (modalBg) {
        document.body.removeChild(modalBg);
        modalBg = null;
    }
}
