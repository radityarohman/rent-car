import Swal from "sweetalert2";

export const confirmDelete = async (doSomething = () => {}) => {
    Swal.fire({
      title: "Yakin Hapus Data?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus !",
    }).then((result) => {
      if (result.isConfirmed) {
        doSomething();
        Swal.fire({
          title: "Data berhasil dihapus !",
          text: "Your file has been deleted.",
          icon: "success",
        });
      }
    });
  };
  