import CreateSektorForm from '@/Components/Form/CreateSektorForm';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head } from '@inertiajs/react';

const CreateSektor = () => {
    return (
        <DashboardLayout>
            <Head title="Buat Sektor" />

            <header className="flex items-baseline justify-between">
                <h2 className="text-[28px] font-semibold leading-[44px] text-gray-900">
                    Buat Sektor Baru
                </h2>
            </header>
            <CreateSektorForm />
        </DashboardLayout>
    );
};

export default CreateSektor;
