import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head } from '@inertiajs/react';

const EditSektor = () => {
    return (
        <DashboardLayout>
            <Head title="Buat Sektor" />

            <header className="flex items-baseline justify-between">
                <h2 className="text-[28px] font-semibold leading-[44px] text-gray-900">
                    Ubah Data Sektor
                </h2>
            </header>
            <div className="container mx-auto">Disini ada Table</div>
        </DashboardLayout>
    );
};

export default EditSektor;
