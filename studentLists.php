<?php include("./template/header.php") ?>
<?php
$countSql = "SELECT COUNT(id) AS total_students FROM students";

$sql = "SELECT *,students.id AS student_id,students.name AS student_name FROM students LEFT JOIN courses ON courses.id = students.course_id LEFT JOIN batches ON batches.id = students.batch_id";


//for search
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $sql .= " WHERE students.name LIKE '%$q%'";
    $countSql .= " WHERE students.name LIKE '%$q%'";
}

$countQuery = mysqli_query($connect, $countSql);
$total_students = mysqli_fetch_assoc($countQuery);
// print_r($total_students);

//for pagination
$total_records = $total_students['total_students'];
$student_per_page = 3;
$total_page = ceil($total_records / $student_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//to show data of each page we think with offset
$offset = ($current_page - 1) * $student_per_page;

$sql .= " ORDER BY students.id DESC LIMIT $offset,$student_per_page";
$query = mysqli_query($connect, $sql);
// var_dump($query);
?>
<!-- Breadcrumb -->
<nav class="flex" aria-label="Breadcrumb">
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
        <li class="inline-flex items-center">
            <a href="" class="inline-flex gap-2 items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                Student Lists
            </a>
        </li>
    </ol>
</nav>

<div class=" mt-5 flex justify-between items-center">
    <div class="">
        <a href="./index.php" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Add New Student</a>
    </div>

    <div class=" flex justify-end">
        <form action="./studentLists.php" method="get">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search.." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>
</div>

<div class=" mt-5 flex justify-end">
    <p class=" text-end inline-block bg-gray-700 px-2 py-1 text-gray-200 rounded-md">
        Showing Results (<?= $total_students['total_students'] ?>) Students
    </p>
</div>

<?php
// print_r($_GET['q']);
if (isset($_GET['q'])) :
?>
    <div class=" mt-5 flex gap-2 justify-end">
        <p class=" bg-gray-700 px-2 py-1 text-gray-200 rounded-md">Search By Student Name "<?= $_GET['q'] ?>"</p>
        <a class="bg-red-600 px-2 py-1 rounded-md text-red-200 " href="./studentLists.php">Clear</a>
    </div>
<?php endif ?>

<div class=" mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Course
                </th>
                <th scope="col" class="px-6 py-3">
                    Batch
                </th>
                <th scope="col" class="px-6 py-3">
                    Fee
                </th>
                <th scope="col" class="px-6 py-3">
                    Start Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Time
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>

        <?php
        while ($row = mysqli_fetch_assoc($query)) :
            // print_r($row);
        ?>
            <tbody>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4">
                        <?= $row["student_name"] ?>
                    </td>
                    <td title="<?= $row["title"] ?>" class="px-6 py-4">
                        <?= $row["short"] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $row["name"] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $row["fee"] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= date("d M Y", strtotime($row["start_date"])) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= date("gA", strtotime($row["start_time"])) ?>
                        <br>
                        <?= date("gA", strtotime($row["end_time"])) ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <a href="./editStudent.php?id=<?= $row["student_id"] ?>" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>

                            <a href="./deleteStudent.php?id=<?= $row["student_id"] ?>" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        <?php endwhile ?>
        <?php if ($query->num_rows === 0) : ?>
            <tr>
                <td class=" px-6 py-4 text-center font-bold text-3xl " colspan="6">There Is No Student With The Name "<?= $_GET['q'] ?>"</td>
            </tr>
        <?php endif ?>
    </table>
</div>

<nav class=" mt-5" aria-label="Page navigation example">
    <ul class="inline-flex -space-x-px text-sm">
        <?php if ($current_page - 1 > 0) : ?>
            <li>
                <a href="./studentLists.php?page=<?= $current_page - 1 ?>&<?= isset($_GET['q']) ? 'q=' . $_GET['q'] : '' ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
        <?php endif ?>
        <?php
        //looping three page next and previous
        $start = $current_page > 3 ? $current_page - 3 : 1;
        $end = $current_page + 3 < $total_page ? $current_page + 3 : $total_page;

        for ($i = $start; $i <= $end; $i++) :
        ?>
            <li>
                <a href="./studentLists.php?page=<?= $i ?>&<?= isset($_GET['q']) ? 'q=' . $_GET['q'] : '' ?>" class="<?= $i == $current_page ? ' bg-blue-700 text-blue-100 hover:bg-blue-700 hover:text-blue-100 ' : '' ?>flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i ?></a>
            </li>
        <?php endfor ?>
        <?php if ($current_page + 1 <= $total_page) : ?>
            <li>
                <a href="./studentLists.php?page=<?= $current_page + 1 ?>&<?= isset($_GET['q']) ? 'q=' . $_GET['q'] : '' ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        <?php endif ?>
    </ul>
</nav>