let taskList = [];

function addTask() {
    const taskInput = document.getElementById('new-task');
    const deadlineInput = document.getElementById('task-deadline');
    const taskValue = taskInput.value.trim();
    const deadlineValue = deadlineInput.value;

    if (!taskValue) {
        alert('Harap masukkan Task sebelum menambahkannya ke daftar.');
        return;
    }

    if (taskValue) {
        const task = {
            id: new Date().getTime(),
            name: taskValue,
            deadline: deadlineValue,
            isEditable: false
        };

        taskList.push(task);
        renderTasks();
        taskInput.value = '';
        deadlineInput.value = '';
    }
}

function renderTasks() {
    const taskUl = document.getElementById('task-list');
    taskUl.innerHTML = '';

    taskList.forEach(task => {
        const taskLi = document.createElement('li');
        const formattedDeadline = task.deadline ? new Date(task.deadline).toLocaleString() : 'No deadline';

        taskLi.innerHTML = `
            <span contenteditable="${task.isEditable}" oninput="editTask(${task.id}, this.innerText)">${task.name}</span>
            ${task.isEditable ? `<input type="datetime-local" class="deadline-input" id="deadline-${task.id}" value="${task.deadline}" onchange="editDeadline(${task.id}, this.value)">` : `<span class="deadline">${formattedDeadline}</span>`}
            <div class="action-buttons">
                <button class="edit-btn" onclick="toggleEdit(${task.id})">
                    <i class="fas ${task.isEditable ? 'fa-save' : 'fa-edit'}"></i>
                </button>
                <button class="delete-btn" onclick="deleteTask(${task.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        taskUl.appendChild(taskLi);
    });
}

function deleteTask(id) {
    taskList = taskList.filter(task => task.id !== id);
    renderTasks();
}

function toggleEdit(id) {
    taskList = taskList.map(task => {
        if (task.id === id) {
            task.isEditable = !task.isEditable;
        }
        return task;
    });
    renderTasks();
}

function editTask(id, newName) {
    taskList = taskList.map(task => {
        if (task.id === id) {
            task.name = newName;
        }
        return task;
    });
}

function editDeadline(id, newDeadline) {
    taskList = taskList.map(task => {
        if (task.id === id) {
            task.deadline = newDeadline;
        }
        return task;
    });
}
