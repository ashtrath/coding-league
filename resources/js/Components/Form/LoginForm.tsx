import { cn } from '@/lib/utils';
import { useForm } from '@inertiajs/react';
import { Form, FormField, FormSubmit } from '@radix-ui/react-form';
import { FormEventHandler } from 'react';
import Button from '../UI/Button';
import { Input, InputLabel, InputMessage } from '../UI/Input';
import Checkbox from '../UI/Input/Checkbox';

const LoginForm = ({ className }: { className?: string }) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <Form onSubmit={handleSubmit} className={cn('grid gap-y-6', className)}>
            <FormField name="email" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Email</InputLabel>
                    <InputMessage match="typeMismatch">
                        Format email tidak valid.
                    </InputMessage>
                    <InputMessage match="valueMissing">
                        Email tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.email}</InputMessage>
                </div>
                <Input
                    type="email"
                    placeholder="Masukan email Anda"
                    autoComplete="email"
                    required
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                />
            </FormField>
            <FormField name="password" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password}</InputMessage>
                </div>
                <Input
                    type="password"
                    placeholder="Masukan kata sandi Anda"
                    autoComplete="current-password"
                    required
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
            </FormField>
            <FormField name="remember" className="flex items-center gap-2">
                <Checkbox id="radix-:r2:" />
                <InputLabel>Ingat Saya</InputLabel>
            </FormField>
            <FormSubmit asChild>
                <Button
                    disabled={processing}
                    className="mt-2.5 w-[300px] place-self-end"
                >
                    Masuk
                </Button>
            </FormSubmit>
        </Form>
    );
};

export default LoginForm;
