<?php include("./template/header.php") ?>
<!-- Breadcrumb -->
<nav class="flex justify-between items-center" aria-label="Breadcrumb">
    <div>
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="./index.php" class="inline-flex gap-2 items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Student Create
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                </div>
            </li>
        </ol>
    </div>
    <div class="flex justify-end">
        <a href="./studentLists.php" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Student Lists</a>
    </div>
</nav>

<form class=" mt-5 mx-auto w-[300px]" action="studentSave.php" method="post">
    <div class="mb-6 ">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
        <input required type="text" id="name" name="name" class="bg-gray-50 border w-full  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
    <div class="mb-6 ">
        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
        <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose A Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="custom">Custom</option>
        </select>
    </div>

    <div class="mb-6 ">
        <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Courses</label>
        <select id="course_id" name="course_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose A Course</option>
            <?php
            $sql = "SELECT * FROM courses";
            $query = mysqli_query($connect, $sql);

            while ($course = mysqli_fetch_assoc($query)) :
            ?>
                <option value="<?= $course["id"] ?>">
                    <?= $course["title"]  ?>
                </option>
            <?php endwhile ?>
        </select>
    </div>
    <div class="mb-6 ">
        <label for="batch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batches</label>
        <select id="batch_id" name="batch_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose A Batch</option>
            <?php
            $sql = "SELECT * FROM batches WHERE is_register_open = 1";
            $query = mysqli_query($connect, $sql);

            while ($batch = mysqli_fetch_assoc($query)) :
            ?>
                <option value="<?= $batch["id"] ?>
             "><?= $batch["name"] ?></option>
            <?php endwhile ?>
        </select>
    </div>

    <div class=" flex justify-end mt-10">
        <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Add New Student</button>
    </div>

    <div>

    </div>
</form>

<?php include("./template/footer.php");
